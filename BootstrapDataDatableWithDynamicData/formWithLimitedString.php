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
            <div class="work-progres">
               <div class="chit-chat-heading">
                  Users
               </div>
               <div class="table-responsive">
                  <table id="example" class="table table-hover">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Project</th>
                           <th>Manager</th>
                           <th>Status</th>
                           <th>Progress</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach ($UsersData['Data'] as $key => $value) { ?>
                        <tr>
                           <td><?php echo $i; ?></td>
                           <td><?php echo $value->username; ?></td>
                           <td><?php echo $value->email; ?></td>
                           <td><?php echo $value->mobile; ?></td>
                           <td>
                              <a href="edituser?uid=<?php echo $value->id; ?>" class=" btn btn-primary">Edit</a>	
                              <a href="" class=" btn btn-danger">Delete</a>	
                           </td>
                        </tr>
                        <?php $i++; } ?>
                     </tbody>
                  </table>
               </div>
            </div>
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
   <script src="https://cdn.datatables.net/plug-ins/1.10.20/dataRender/ellipsis.js"></script>
   <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> -->
   <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
   <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> -->
   <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> -->
   <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script> -->
   <script>
      jQuery.fn.dataTable.render.ellipsis = function ( cutoff, wordbreak, escapeHtml ) {
          var esc = function ( t ) {
              return t
                  .replace( /&/g, '&amp;' )
                  .replace( /</g, '&lt;' )
                  .replace( />/g, '&gt;' )
                  .replace( /"/g, '&quot;' );
          };
       
          return function ( d, type, row ) {
              // Order, search and type get the original data
              if ( type !== 'display' ) {
                  return d;
              }
       
              if ( typeof d !== 'number' && typeof d !== 'string' ) {
                  return d;
              }
              d = d.toString(); // cast numbers
              if ( d.length <= cutoff ) {
                  return d;
              }
              var shortened = d.substr(0, cutoff-1);
       
              // Find the last white space character in the string
              if ( wordbreak ) {
                  shortened = shortened.replace(/\s([^\s]*)$/, '');
              }
              // Protect against uncontrolled HTML input
              if ( escapeHtml ) {
                  shortened = esc( shortened );
              }
              return '<span class="ellipsis" title="'+esc(d)+'">'+shortened+'&#8230;</span>';
          };
      };
      
      $('#example').DataTable( {
        columnDefs: [ {
            targets: 2,
            render: $.fn.dataTable.render.ellipsis( 17, true )
          } ]
      } );
      
   </script>
</html>