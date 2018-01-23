                    <?=get_ol($items)?>

    <script type="text/javascript">
          $('.sortable').nestedSortable({
              handle: 'div',
              items: 'li',
              toleranceElement: '> div',
              maxLevels: 2
          }); 
                    	
    </script>