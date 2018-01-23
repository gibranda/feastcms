(function () {

    function createElementsFromHtml(html) {
    var div = document.createElement('div');
    div.innerHTML = html;
    return div.childNodes;
}

function getDocHead(doc) {
    return doc.getElementsByTagName('head')[0];
}

function getDocBody(doc) {
    return doc.getElementsByTagName('body')[0];
}

function removeLinkFromDoc(doc, src) {
    var links = doc.getElementsByTagName('link');
    var alreadyExists = false;
    for(var i = links.length-1; i >= 0; i--)
        if (links[i].href == src)
            links[i].parentNode.removeChild(links[i]);
}

function addLinkToDoc(doc, src) {
    if (!doc)
        return;
    var links = doc.getElementsByTagName('link');
    var alreadyExists = false;
    for(var i=0;i<links.length;i++)
        if (links[i].href.indexOf(src) != -1)
            alreadyExists = true;
    if (!alreadyExists) {
        var link = doc.createElement('link');
        link.href = src;
        link.type="text/css";
        link.rel="stylesheet";
        getDocHead(doc).appendChild(link);
    }
}

function addScriptToDoc(doc, src) {
    if (!doc)
        return;
    var scripts = doc.getElementsByTagName('script');
    var alreadyExists = false;
    for(var i=0;i<scripts.length;i++)
        if (scripts[i].src.indexOf(src) != -1)
            alreadyExists = true;
    if (!alreadyExists) {
        var script = doc.createElement('script');
        script.src = src;
        script.type="text/javascript";
        getDocHead(doc).appendChild(script);
    }
}

function addLinkToEditor(editor, src, andToGlobalDoc){
    addLinkToDoc(getEditorDocumentElement(editor), src);
    if (document != getEditorDocumentElement(editor) && andToGlobalDoc)
        addLinkToDoc(document, src);
}

function addScriptToEditor(editor, src, andToGlobalDoc){
    addScriptToDoc(getEditorDocumentElement(editor), src);
    if (document != getEditorDocumentElement(editor) && andToGlobalDoc)
        addScriptToDoc(document, src);
}

function embedCssStyles(editor, stylesheet){
    var doc = getEditorDocumentElement(editor);
    embedCssStylesToDoc(doc, stylesheet);
}

function embedCssStylesToDoc(doc, stylesheet) {
    var style = doc.createElement('style');
    getDocHead(doc).appendChild(style);
    style.innerHTML = stylesheet;
}

function addClass(el, cls) {
    if (hasClass(el, cls))
        return;
    el.className = el.className.length == 0 ? cls : el.className + ' ' + cls;
}

function removeClass(el, cls) {
    var classes = getClasses(el);
    while (classes.indexOf(cls) > -1)
        classes.splice(classes.indexOf(cls), 1);
    var newCls = classes.join(' ').trim();
    if (newCls.length > 0)
        el.className = newCls;
    else if (el.hasAttribute('class'))
        el.removeAttribute('class');
}

function getClasses(el) {
    if (typeof(el.className) === 'undefined' || el.className == null)
        return [];
    return el.className.split(/\s+/);
}

function hasClass(el, cls) {
    var classes = getClasses(el);
    for (var i=0; i<classes.length; i++)
        if (classes[i].toLowerCase() == cls.toLowerCase())
            return true;
    return false;
}

function hasClassStartsWith(el, clsPart) {
    var classes = getClasses(el);
    for (var i=0; i<classes.length; i++)
        if (classes[i].indexOf(clsPart) === 0)
            return true;
    return false;
}

function getStyles(el) {
    if (typeof(el.getAttribute('style')) === 'undefined' || el.getAttribute('style') == null || el.getAttribute('style').trim().length == 0)
        return {};
    var styles = {};
    var strStyles = el.getAttribute('style').split(/;/);
    for (var i=0; i<strStyles.length; i++) {
        var strStyle = strStyles[i].trim();
        var index = strStyle.indexOf(':');
        if (index > -1) {
            styles[strStyle.substr(0, index).trim()] = strStyle.substr(index+1);
        } else {
            styles[strStyle] = '';
        }
    }
    return styles;
}

function getStyle(el, styleName) {
    var styles = getStyles(el);
    for (var name in styles) {
        var value = styles[name];
        if (name == styleName)
            return value;
    }
    return null;
}

function hasStyle(el, styleName, styleValue) {
    var styles = getStyles(el);
    for (var name in styles) {
        var value = styles[name];
        if (name == styleName && value == styleValue)
            return true;
    }
    return false;
}

function setStyle(el, styleName, styleValue) {
    var styles = getStyles(el);
    styles[styleName] = styleValue;
    setStyles(el, styles);
}

function removeStyle(el, styleName) {
    var styles = getStyles(el);
    delete styles[styleName];
    setStyles(el, styles);
}

function setStyles(el, styles) {
    var strStyles = [];
    for (var name in styles)
        strStyles.push(name + ":" + styles[name]);
    if (strStyles.length > 0)
        el.setAttribute('style', strStyles.join(';'))
    else if (el.hasAttribute('style'))
        el.removeAttribute('style');
}

function getElementsByTagNameOnlyChildren(el, tagNameOrArray) {
    var tags;
    if( Object.prototype.toString.call(tagNameOrArray) === '[object Array]' )
        tags = tagNameOrArray
    else
        tags = [tagNameOrArray];
    for (var i=0; i<tags.length; i++)
        tags[i] = tags[i].toLowerCase();

    var result = [];
    for (var i=0; i < el.childNodes.length; i++)
        if (el.childNodes[i].nodeType == 1 && tags.indexOf(el.childNodes[i].tagName.toLowerCase()) > -1)
            result.push(el.childNodes[i]);
    return result;
}

/**
 * Detects location of the script by its file name.
 * @return null if no base URL detected, URL if there was appropriate URL found.
 * @param filenamePartRegexp String/Regexp A regular expression which matches to JS script name (without extension).
 */
function getBaseURL(filenamePartRegexp) {
    var basePathSrcPattern = new RegExp('(^|.*[\\\/])' + filenamePartRegexp + '\.js(?:\\?.*|;.*)?$', 'i');
    var path = '';
    if ( !path ) {
        var scripts = document.getElementsByTagName( 'script' );
        for ( var i = 0; i < scripts.length; i++ ) {
            var match = basePathSrcPattern.exec(scripts[ i ].src);
            if ( match ) {
                path = match[ 1 ];
                break;
            }
        }
    }
    // In IE (only) the script.src string is the raw value entered in the
    // HTML source. Other browsers return the full resolved URL instead.
    if ( path.indexOf( ':/' ) == -1 && path.slice( 0, 2 ) != '//' ) {
        // Absolute path.
        if ( path.indexOf( '/' ) === 0 )
            path = location.href.match( /^.*?:\/\/[^\/]*/ )[ 0 ] + path;
        // Relative path.
        else
            path = location.href.match( /^[^\?]*\/(?:)/ )[ 0 ] + path;
    }
    return path.length > 0 ? path : null;
}
    function getEditorName() { return 'ckeditor'; }
function isEditorInline(editor) { return editor.elementMode == 3; }

// Возвращает не ID элемента редактора, а уникальную для его инстанса строку, пригодную в качестве префиксов
function getEditorId(editor) { return editor.name.replace(/\[/, '_').replace(/\]/, '_'); }

// Возвращает корневой HTML DOM-элемент редактора
function getEditorElement(editor) { return editor.container.$; }
function getEditorDocumentElement(editor) { return editor.document.$; }

function getEditorContent(editor) { return editor.getSnapshot(); }
function setEditorContent(editor, html) { editor.loadSnapshot(html); }

// Returns selected image element or null
function getEditorSelectedImage(editor) {
    var element = getEditorSelectedElement(editor);
    if (element != null && element.tagName == 'SPAN' && element.getAttribute("data-cke-display-name") == "image") {
        // widget, img is inside
        var els = element.getElementsByTagName("IMG");
        element = null;
        for (var i = 0; i < els.length && element == null; i++)
            if (els.item(i).tagName === "IMG")
                element = els.item(i);
    }
    if (element != null && element.tagName == "IMG")
        return element;
    return null;
}

function getEditorSelectedElement(editor) {
    if (editor.getSelection() == null)
        return null;
    //var el = editor.getSelection().getSelectedElement();
    var el = editor.getSelection().getStartElement();
    if (el && el.$)
        return el.$;
    return null;
}

function getEditorUrl() { return CKEDITOR.basePath; }
function getEditorPluginUrl() { return getEditorOtherPluginUrl('template_builder_buttons'); }
function getEditorOtherPluginUrl(pluginName) { return CKEDITOR.plugins.getPath(pluginName); }
function getEditorVersion() { return CKEDITOR.version.charAt(0) == '3' ? 3 : 4; }
function getEditorMinorVersion() { return ''; }
function getEditorStr(editor, strName) {
    if (getEditorVersion() == 3) {
        var key = (strName.indexOf('template_builder_buttons_') == -1) ? ('template_builder_buttons_' + strName) : strName;
        if (typeof(editor.lang[key]) !== 'undefined')
            return editor.lang[key];
        else
            console.log("(v3) editor.lang['template_builder_buttons'] not defined");
    } else {
        if (typeof(editor.lang['template_builder_buttons']) !== 'undefined') {
            if (typeof(editor.lang['template_builder_buttons'][strName]) !== 'undefined') {
                return editor.lang['template_builder_buttons'][strName];
            } else {
                console.log("editor.lang['template_builder_buttons']['" + strName + "'] not defined");
            }
        } else {
            console.log("editor.lang['template_builder_buttons'] not defined");
        }
    }
    return "";
}
function getEditorPluginParameter(editor, parameterName) { return getEditorParameter(editor, 'template_builder_buttons_' + parameterName); }

function getEditorParameter(editor, parameterName) {
    var value = editor.config[parameterName];
    return value;
}
function setEditorDefaultPluginParameter(parameterName, parameterValue) { setEditorDefaultParameter('template_builder_buttons_' + parameterName, parameterValue); }
function setEditorDefaultParameter(parameterName, parameterValue) { CKEDITOR.config[parameterName] = parameterValue; }

function editorInsertHtml(editor, html) {
    var element = CKEDITOR.dom.element.createFromHtml(html);
    if (element.type == CKEDITOR.NODE_TEXT)
        editor.insertText(html);
    else
        editor.insertElement(element);
}

function getEditorIconSuffix() { return '' } // always '' for CKEditor, all other suffixes are for TinyMCE

var BTN_STATE_DISABLED = 0;
var BTN_STATE_OFF = 1;
var BTN_STATE_ON = 2;
function setEditorButtonState(editor, btnName, state) {
    var btnState = null;
    if (state == BTN_STATE_DISABLED)
        btnState = CKEDITOR.TRISTATE_DISABLED;
    else if (state == BTN_STATE_OFF)
        btnState = CKEDITOR.TRISTATE_OFF;
    else if (state == BTN_STATE_ON)
        btnState = CKEDITOR.TRISTATE_ON;
    if (btnState != null && editor.ui && editor.ui.get(btnName))
        editor.ui.get(btnName).setState(btnState);
}

function addEditorEventListenerOnSelectionChange(editor, func) {
    editor.on('selectionChange', function(evt) {
        func(evt.editor);
    });
}

// Dec 2015 API
// Tested with:
// - mode
// - beforeGetOutputHTML (our own event)
// - contentDom
// - keyDown
// - selectionChange
// - elementsPathUpdate
// - keyDown
function editorAddListener(editor, eventName, func) {
    if (eventName == 'beforeGetOutputHTML') {
        editor.on( 'toDataFormat', function( evt ) {
            return func(editor, evt.data.dataValue);
        }, null, null, 4 );
        return;
    }
    if (eventName == 'keyDown') {
        editor.on('key',
            (function() {
                var _editor = editor;
                var _func = func;
                return function(evt) {
                    _func(_editor, evt.data.keyCode, evt);
                }
            })()
        );
        return;
    }
    editor.on(eventName, (function() {
        var _editor = editor;
        return function() { func(_editor); }
    })());
}

function cancelEvent(evt) {
    evt.cancel();
};

function editorAddButton2(
    editor,
    buttonName,
    iconName, // file name without path and ext. For example "jsplus_plugin" => URL will be "icons/jsplus_plugin.png"
    tooltipTextKey,  // will be localized inside this function
    onClick, // function(editor)
    context, // not used - for TinyMCE only
    doHighlight
) {
    editor.addCommand( buttonName, { exec: onClick } );
    editor.ui.addButton( buttonName, {
        title: getEditorStr(editor, tooltipTextKey.replace(/^jsplus_/, '')),
        label: getEditorStr(editor, tooltipTextKey.replace(/^jsplus_/, '')),
        icon: getEditorPluginUrl() + 'icons/' + iconName + '.png',
        command: buttonName,
        className: doHighlight ? "jsplus_framework_button" : ""
    });
}

// Returnes `true` if editor is in visual mode, `false` if in source
function editorIsWYSIWYG(editor) {
    return editor.mode == 'wysiwyg';
}

function addPlugin(pluginName, langs, initFunc) {
    if (!(pluginName in CKEDITOR.plugins.registered)) {
        CKEDITOR.plugins.add( pluginName, {
            icons: pluginName,
            lang: langs,
            init: function( editor ) {
                initFunc(editor);
            }
        });
    }
}

function loadJSDialog() {
    JSDialog.Config.skin = null;
    JSDialog.Config.templateDialog =
        '<div class="jsdialog_plugin_template_builder_buttons jsdialog_dlg cke_dialog cke_ltr">' +
            '<div class="cke_dialog_body">' +
                '<div class="jsdialog_title cke_dialog_title">' +
                    '<div class="jsdialog_title_text"></div>' +
                    '<a class="jsdialog_x cke_dialog_close_button" href="javascript:void(0)" style="-webkit-user-select: none;">' +
                        '<span class="cke_label">X</span>' +
                    '</a>' +
                '</div>' +
                '<div class="jsdialog_content_wrap cke_dialog_contents">' +
                    '<div class="jsdialog_content"></div>' +
                '</div>' +
                '<div class="cke_dialog_footer">' +
                    '<div class="jsdialog_buttons cke_dialog_footer_buttons"></div>' +
                '</div>' +
            '</div>' +
        '</div>';
    JSDialog.Config.templateButton = '<a><span class="cke_dialog_ui_button"></span></a>';
    JSDialog.Config.templateBg = '<div class="jsdialog_plugin_template_builder_buttons jsdialog_bg"></div>';
    JSDialog.Config.classButton = 'cke_dialog_ui_button';
    JSDialog.Config.classButtonOk = 'cke_dialog_ui_button_ok';
    JSDialog.Config.contentBorders = [3, 1, 15, 1, 51];

    if (typeof CKEDITOR.skinName === 'undefined')
        CKEDITOR.skinName = CKEDITOR.skin.name; // fix for some CKEditor versions, in opposite way loadPart() will crash
    CKEDITOR.skin.loadPart( 'dialog' ); // without this line if user opens the first dialog ever and it is JSDialog no CKEditor dialog CSS will be used

    embedCssStylesToDoc(document,
        ".jsdialog_plugin_template_builder_buttons.jsdialog_bg { background-color: white; opacity: 0.5; position: fixed; left: 0; top: 0; width: 100%; height: 3000px; z-index: 11111; display: none; }"  +
            ".jsdialog_plugin_template_builder_buttons.jsdialog_dlg { font-family: Arial; padding: 0; position: fixed; z-index: 11112; background-color: white; border-radius: 5px; overflow:hidden; display: none; }" +
            ".jsdialog_plugin_template_builder_buttons.jsdialog_show { display: block; }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_contents { font-size: 16px; padding: 10px 0 10px 7px; display: table; overflow: hidden; }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_contents_inner { display: table-cell; vertical-align: middle; }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_icon { padding-left: 100px; min-height: 64px; background-position: 10px 10px; background-repeat: no-repeat; box-sizing: content-box; }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_icon_info { background-image: url(img/info.png); }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_icon_warning { background-image: url(img/warning.png); }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_icon_error { background-image: url(img/error.png); }" +
            ".jsdialog_plugin_template_builder_buttons .jsdialog_message_icon_confirm { background-image: url(img/confirm.png); }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_contents { margin-top: 0; border-top: none; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_footer div { outline: none; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_footer_buttons > .cke_dialog_ui_button { margin-right: 5px; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_footer_buttons > .cke_dialog_ui_button:last-child { margin-right: 0; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_title { cursor: default; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_contents { padding: 0; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_ui_button { padding: inherit; }" +
            ".jsdialog_plugin_template_builder_buttons .cke_dialog_ui_button:hover, .jsdialog_plugin_template_builder_buttons .cke_dialog_ui_button:focus { text-decoration: none; }"
    );
}

    /*-------------------*/

    addPlugin('template_builder_buttons', '', init);

    function isCol(el) {
        if (!(el != null && el.nodeType === 1 && el.nodeName === "DIV"))
            return false;
        var classes = getClasses(el);
        for (var _i = 0, classes_1 = classes; _i < classes_1.length; _i++) {
            var cls = classes_1[_i];
            var arr = cls.match(/^col-(xs|sm|md|lg|xl)-(\d{1,2})$/i);
            return (arr != null) && (arr[2].length === 1 || arr[2].substr(0, 1) === "1");
        }
        return false;
    }

    function getNeightborCol(elCol, deltaY) {
        var elTmp = elCol;
        while (deltaY !== 0) {
            if (deltaY < 0) {
                elTmp = elTmp.previousSibling;
                if (elTmp == null)
                    return null;
                if (isCol(elTmp))
                    deltaY++;
            }
            else {
                elTmp = elTmp.nextSibling;
                if (elTmp == null)
                    return null;
                if (isCol(elTmp))
                    deltaY--;
            }
        }
        return elTmp;
    }

    function getData(editor) {
        if ("template_builder_buttons" == "template_builder_buttons")
            return [
                {
                    name: "bootstrap_editor_col_conf",
                    title: null,
                    hint: "Configure the column",
                    icon: CKEDITOR.basePath + "../../../icons/conf.png",
                    onClick: function(editor) {
                        window.template_builder_callback(editor, "col_conf");
                    }
                },
                // {
                //     name: "bootstrap_editor_col_change_type",
                //     title: null,
                //     hint: "Change type of the column",
                //     icon: CKEDITOR.basePath + "../../../icons/pallete.png",
                //     onClick: function(editor) {
                //         window.template_builder_callback(editor, "col_plugin");
                //     }
                // },
                {
                    name: "bootstrap_editor_col_move_left",
                    title: null,
                    hint: "Move the column left",
                    icon: CKEDITOR.basePath + "../../../icons/left.png",
                    onClick: function(editor) {
                        window.template_builder_callback(editor, "col_move_left");
                        setEditorButtonState(editor, "bootstrap_editor_col_move_left", getNeightborCol(getEditorElement(editor), -1) == null ? BTN_STATE_DISABLED : BTN_STATE_OFF);
                    },
                    onMode: function(editor) {
                        setEditorButtonState(editor, "bootstrap_editor_col_move_left", getNeightborCol(getEditorElement(editor), -1) == null ? BTN_STATE_DISABLED : BTN_STATE_OFF);
                    }
                },
                {
                    name: "bootstrap_editor_col_move_right",
                    title: null,
                    hint: "Move the column right",
                    icon: CKEDITOR.basePath + "../../../icons/right.png",
                    onClick: function(editor) {
                        window.template_builder_callback(editor, "col_move_right");
                        setEditorButtonState(editor, "bootstrap_editor_col_move_right", getNeightborCol(getEditorElement(editor), 1) == null ? BTN_STATE_DISABLED : BTN_STATE_OFF);
                    },
                    onMode: function(editor) {
                        setEditorButtonState(editor, "bootstrap_editor_col_move_right", getNeightborCol(getEditorElement(editor), 1) == null ? BTN_STATE_DISABLED : BTN_STATE_OFF);
                    }
                },
                {
                    name: "bootstrap_editor_col_add",
                    title: null,
                    hint: "Add a column",
                    icon: CKEDITOR.basePath + "../../../icons/add.png",
                    onClick: function(editor) {
                        window.template_builder_callback(editor, "col_add");
                    }
                },
                {
                    name: "bootstrap_editor_col_delete",
                    title: null,
                    hint: "Delete the column",
                    icon: CKEDITOR.basePath + "../../../icons/delete.png",
                    classes: "jsplus_bootstrap_button_red",
                    onClick: function(editor) {
                        window.template_builder_callback(editor, "col_delete");
                    }
                }
            ];
        var data = getEditorParameter(editor, "template_builder_buttons");
        if (typeof data === "undefined" || data == null)
            data = [];
        return data;
    }

    function init(editor) {

        if (false) { DrupalHack.addButton('template_builder_buttons', { icon: this.path + 'icons/template_builder_buttons.png' }); }

        var data = getData(editor);
        for (var i=0; i<data.length; i++) {

            // btn = { title: string, hint: string, icon: string#url, onClick: func(editor) }
            var btn = data[i];

            var buttonName = "template_builder_buttons_" + i;
            if (typeof btn["name"] !== "undefined" && btn["name"] != null)
                buttonName = btn["name"];

            var classes = btn["classes"];
            if (typeof classes === "undefined" || classes == null)
                classes = [];

            if (getEditorName() == "ckeditor") {
                editor.addCommand(buttonName, {exec: btn["onClick"]});
                editor.ui.addButton(buttonName, {
                    title: btn["hint"],
                    label: btn["title"],
                    icon: btn["icon"],
                    command: buttonName,
                    className: classes
                });
            } else {
                // TODO:
            }

            editorAddListener(editor, "mode", (function() {
                var _data = data;
                return function(editor) {
                    for (var i=0; i<_data.length; i++) {
                        var btn = data[i];
                        if (btn.onMode)
                            btn.onMode(editor);
                    }
                }
            })());

        }
    }

})();