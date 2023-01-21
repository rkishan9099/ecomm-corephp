

CKEDITOR.replace('desc');
  CKEDITOR.replace('short_desc');
  CKEDITOR.replace('tech_spec');
  CKEDITOR.replace('keyword');
  

  var loop_img = 1;
  function addImg(){
    loop_img++;
    var img_html = `    <div class="col-md-12" id="product_img_${loop_img}">
          <div class="card">
            <div class="card-body">
              <div class="form-row">
                
             
              <div class="form-group col-md-10">
                <label>Product image</label>
                <input type="file" name="product_img[]" class="form-control">
              </div>
              <div class="col-2">
                <label class="form-inline">&nbsp; &nbsp;</label>
                <button class="btn btn-danger btn-lg btn-block" type="button"><i class="fa fa-minus" onclick="removeImg(${loop_img})"></i> Remove</button>
              </div>
           </div>
            </div>
          </div>
        </div>`;
    $("#product_img_1").append(img_html);
  }
  
  function removeImg(count){
    //alert("remove");
    $("#product_img_"+count).remove();
  }
  
  
  
var loopcount = 1;
  function Add() {
   
    loopcount++;
    var color = $("#color").html();
    color =color.replace("selected", "");
    var size = $("#size").html();
    size = size.replace("selected","");
    var html = `  <div class="col-md-12" id="product_attr_${loopcount}">
          <div class="card">
            <div class="card-body">
              <div class="form-row">
                  <input type="hidden" class="form-control" id="qty" name="id[]" value="" required  >
                
                <div class="form-group col-md-2 col-sm-4">
                  <label>Sku</label>
                  <input type="text" class="form-control" id="sku" name="sku[]"  >
                </div>
                <div class="form-group col-md-2 col-sm-4">
                  <label>Mrp</label>
                  <input type="number" class="form-control" id="mrp" name="mrp[]"  >
                </div>
                <div class="form-group col-md-2 col-sm-4">
                  <label>Qty</label>
                  <input type="number" class="form-control" id="qty" name="qty[]"  >
                </div>
                  <div class="form-group col-md-2 col-sm-4">
                  <label>Price</label>
                  <input type="number" class="form-control" id="qty" name="price[]"  >
                </div>
   
                 
              
                <div class="form-group col-md-2 col-sm-4">
                  <label>Size</label>
                  <select class="form-control" name="size[]" id="size">;
                   ${size}
                  </select>
                </div>
                <div class="form-group col-md-2 col-sm-4">
                  <label>Color</label>
                 <select class="form-control" name="color[]" id="color">;
               ${color}
             </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4 col-sm-8">
                  <label>Image</label>
                  <input type="file" class="form-control" name="attr_img[]">
                </div>
                <div class="form-group col-3">
                  <label class="form-inline">&nbsp; &nbsp;</label>
                  <button class="btn btn-danger btn-lg" onclick="remove(${loopcount})"><i class="fa fa-minus"></i>
                    Remove</button>
                </div>
                   <div class="form-group col-2">
                  <input type="text" name="id_attr[]" value="">
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>`;
        
    $("#product_attr_1").append(html);
  }
  function remove(count){
   $("#product_attr_"+count).remove();
  }
  
  
  
