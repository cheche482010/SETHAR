<?php include(call . "Inicio.php"); ?>

<!-- Contenido de la pagina -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Plantas IA</h1>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <!-- Default box -->
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Reino plantae</h3>
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
               </button>
            </div>
         </div>
         <div class="card-body w-100">
            
         </div>

         <!-- /.card-footer-->
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
   <!-- /.content -->
</div>

<!-- /.content-wrapper -->
<footer class="main-footer">
   <strong>
      &copy; Reino Plantae <?php echo "2021"; echo "-" . date('Y') ?> .
   </strong>
   <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 4.0
   </div>
</footer>
</main>
<?php include(call . "Script.php"); ?>
<?php include(call . "regitro.php"); ?>
<script type="text/javascript" src="<?php echo constant('URL') ?>vista/inicio/js/plantas-cosulta.js"></script>
<script type="text/javascript" src="<?php echo constant('URL') ?>vista/inicio/js/brain.min.js"></script>
</body>

</html>