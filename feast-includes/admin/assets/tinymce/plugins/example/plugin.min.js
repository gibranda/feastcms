tinymce.PluginManager.add("example",function(a,b){
	a.addButton("example",{
		text:"Example plugin",
		context:"tools",
		onclick:function(){
			a.windowManager.open({
				title:"My shortcodes",
				url:b+"/dialog.html",
				width:600,
				height:400,
				buttons:[
				{
					text:"Insert",
					onclick:function(){
						var b=a.windowManager.getWindows()[0];
						a.insertContent(b.getContentWindow().document.getElementById("content").value),
						b.close()
					}
				},
				{
					text:"Close",
					onclick:"close"
				}
				]
			})
		}
	}),
	a.addMenuItem("example",{
		text:"My button",
		icon:!1,
		onclick:function(){
			a.windowManager.open({
				title:"Example plugin",
				body:[{
					type:"textbox",
					name:"title",
					label:"Title"
				}],
				onsubmit:function(b){
					a.insertContent("Title: "+b.data.title)
				}
			})
		}
	})
});