<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <?php foreach ($data as $keyC => $valueC) { ?>
  <li class="nav-item">
    <a class="nav-link <?php echo ($keyC == 0 ? "active" : "");?>"  data-toggle="tab" href="#CatalogTabs<?php echo $valueC->id;?>" role="tab" aria-controls="CatalogTabs<?php echo $valueC->id;?>" aria-selected="true"><?php echo $valueC->name;?></a>
  </li>
<?php } ?>
 
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <?php foreach ($data as $keyC => $valueC) { ?>
  <div class="tab-pane <?php echo ($keyC == 0 ? "active" : "");?>" id="CatalogTabs<?php echo $valueC->id;?>" role="tabpanel" aria-labelledby="CatalogTabs<?php echo $valueC->id;?>">
    
    <div class="row">
    <?php foreach ($valueC->posts as $key => $value) { ?>
      <div class="col-lg-five col-md-6 col-sm-12 <?php echo ($key < 5 ? "mb-3" : "mb-lg-0 mb-sm-3");?> flex-box" data-animated-action="<?php echo (@$attr["animated"] ? $attr["animated"] : "");?>">
        <div class="card text">
          <div class="card-header-top">
          <a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name,"lazy" => @$attr["lazy"]]);?></a>
          </div>
          <div class="card-body">
            <strong class="line-2"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></strong>
           
            <p class="line-3"><?php echo $value->description;?></p>
           
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
    
  </div>
  <?php } ?>
</div>