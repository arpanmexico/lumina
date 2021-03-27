 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Control</h1>
 </div>

 <!-- Content Row -->
 <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-warning shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                             Administradores</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $usuario -> getCountAdmin()?></div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-comments fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="col-xl-3 col-md-6 mb-4">
         <div class="card border-left-info shadow h-100 py-2">
             <div class="card-body">
                 <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                             Pacientes</div>
                         <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $usuario -> getCountPatients(); ?></div>
                     </div>
                     <div class="col-auto">
                         <i class="fas fa-comments fa-2x text-gray-300"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="row my-4">
    <div class="col col-sm-12 col-md-12 col-lg-12 card border-left-primary shadow">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-6">
                    <h6 class="text-primary my-0 font-weight-bold">Ingresos por mes</h6>
                </div>
                <div class="col-6">
                    <select name="" id="selectYear" class="form-control">
                        <?php
                            $currentYear = date("Y");
                            echo '
                            <option value="'.$currentYear.'" selected>'.$currentYear.'</option>
                            '; 
                           
                            for($i = 1; $i < 5; $i++){
                                echo '
                                <option value="'.($currentYear - $i).'" class="">'.($currentYear - $i) .'</option>
                                ';
                            }
                        ?>

                        
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
        <div id="soldMsg"></div>
            <canvas id="soldChart"></canvas>
        </div>
    </div>
    
 </div>