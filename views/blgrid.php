<div id="toolbar-all">
	<button id="blkDelete"><?php echo _("Delete Selected")?></button>
	<a href="#" class="btn btn-default" data-toggle="modal" data-target="#addNumber"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo _("Blacklist Number")?></a>
</div>
<table id="blGrid" data-toolbar="#toolbar-all" data-url="ajax.php?module=blacklist&command=getJSON&jdata=grid" data-cache="false" data-maintain-selected="true" data-show-columns="true" data-show-toggle="true" data-toggle="table" data-pagination="true" data-search="true" class="table table-striped">
    <thead>
          <tr>
						<th data-checkbox="true" data-formatter="cbFormatter"></th>
            <th data-field="number"><?php echo _("Number")?></th>
            <th data-field="description"><?php echo _("Description")?></th>
            <th data-field="number" data-formatter="linkFormatter"><?php echo _("Actions")?></th>
        </tr>
    </thead>
</table>


<script type="text/javascript">
	var cbrows = [];
	function cbFormatter(val,row,i){
		cbrows[i] = row['number'];
	}

	function linkFormatter(value,row){
		var html = '<a href="#" data-toggle="modal" data-target="#addNumber" data-number="'+value+'" data-description="'+row['description']+'" ><i class="fa fa-pencil"></i></a>';
		html += '&nbsp;<a href="#" id="del'+value+'" data-number="'+value+'"><i class="fa fa-trash"></i></a>';
		return html;
	}

	$("#blkDelete").click(function(e){
		e.preventDefault();
		if(confirm(_("Are you sure you want to remove the selected item(s) from the blacklist?"))){
			$('input[name="btSelectItem"]:checked').each(function(){
				var num = cbrows[$(this).data("index")];
				$.post("ajax.php?module=blacklist",
					{
						command : "del",
						number : num,
					}
				);
				$('#blGrid').bootstrapTable('remove',{field:'number', values:[num]});
			});
			$('#blGrid').bootstrapTable('refresh',{});
		}
	});
</script>