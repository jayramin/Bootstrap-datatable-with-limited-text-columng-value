<?php
include_once('mymodel.php');
$Ob = new mymodel;
$UsersData = $Ob->SelectData('users');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
</head>
<body>
<div class=" container chit-chat-layer1">
	<div class="col-md-12 chit-chat-layer1-left">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Priority</th>
                <th>Item</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
  </div>
  <div class="clearfix"> </div>
</div>
</body>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>

<script>
// Todo field type plug-in code
(function ($, DataTable) {
 
 if ( ! DataTable.ext.editorFields ) {
     DataTable.ext.editorFields = {};
 }
  
 var Editor = DataTable.Editor;
 var _fieldTypes = DataTable.ext.editorFields;
  
 _fieldTypes.todo = {
     create: function ( conf ) {
         var that = this;
  
         conf._enabled = true;
  
         // Create the elements to use for the input
         conf._input = $(
             '<div id="'+Editor.safeId( conf.id )+'">'+
                 '<button type="button" class="inputButton" value="0">To do</button>'+
                 '<button type="button" class="inputButton" value="1">Done</button>'+
             '</div>');
  
         // Use the fact that we are called in the Editor instance's scope to call
         // the API method for setting the value when needed
         $('button.inputButton', conf._input).click( function () {
             if ( conf._enabled ) {
                 that.set( conf.name, $(this).attr('value') );
             }
  
             return false;
         } );
  
         return conf._input;
     },
  
     get: function ( conf ) {
         return $('button.selected', conf._input).attr('value');
     },
  
     set: function ( conf, val ) {
         $('button.selected', conf._input).removeClass( 'selected' );
         $('button.inputButton[value='+val+']', conf._input).addClass('selected');
     },
  
     enable: function ( conf ) {
         conf._enabled = true;
         $(conf._input).removeClass( 'disabled' );
     },
  
     disable: function ( conf ) {
         conf._enabled = false;
         $(conf._input).addClass( 'disabled' );
     }
 };
  
 })(jQuery, jQuery.fn.dataTable);
  
  
 var editor; // use a global for the submit and return data rendering in the examples
  
 $(document).ready(function() {
     editor = new $.fn.dataTable.Editor( {
         ajax: "../php/todo.php",
         table: "#example",
         fields: [ {
                 label: "Item:",
                 name: "item"
             }, {
                 label: "Status:",
                 name: "done",
                 type: "todo", // Using the custom field type
                 def: 0
             }, {
                 label: "Priority:",
                 name: "priority",
                 type: "select",
                 options: [
                     { label: "1 (highest)", value: "1" },
                     { label: "2",           value: "2" },
                     { label: "3",           value: "3" },
                     { label: "4",           value: "4" },
                     { label: "5 (lowest)",  value: "5" }
                 ]
             }
         ]
     } );
  
     $('#example').DataTable( {
         dom: "Bfrtip",
         ajax: "../php/todo.php",
         columns: [
             { data: "priority", className: "center" },
             { data: "item" },
             {
                 className: "center",
                 data: "done",
                 render: function (data, type, row) {
                     if ( type === 'display' || type === 'filter' ) {
                         // Filtering and display get the rendered string
                         return data == 0 ? "To do" : "Done";
                     }
                     // Otherwise just give the original data
                     return data;
                 }
             }
         ],
         select: true,
         buttons: [
             { extend: "create", editor: editor },
             { extend: "edit",   editor: editor },
             { extend: "remove", editor: editor }
         ]
     } );
 } );
</script>
</html>
