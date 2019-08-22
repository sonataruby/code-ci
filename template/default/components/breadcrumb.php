<div>
    <h3 class="float-left hidden-xs"><?php echo $active;?></h3>
    <div class="float-right">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url();?>"><i class="fa fa-home"></i></a></li>
            <?php 

            foreach ($data as $key => $value) { 
                
                ?>
                <?php if($value->catalog_url != '#'){ ?>
                    <li class="breadcrumb-item"><a href="<?php echo catalog_url($value->catalog_url, $value->channel);?>"><?php echo $value->catalog_name;?></a></li>
                <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="#"><?php echo $value->catalog_name;?></a></li>
                <?php } ?>
            <?php } ?>
            
            
          </ol>
        </nav>
    </div>
</div>
<div class="clearfix"></div>