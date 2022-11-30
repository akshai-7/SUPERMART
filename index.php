<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
   <link rel="stylesheet" href="new.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  

</head>
<body>
    <div class="container pt-5">
            <?php
            session_start();
            $_SESSION[""] = "id";

            $con=mysqli_connect("localhost","root","","invoice_db");
            if(isset($_POST['submit'])){
                $invoice_no=$_POST['invoice_no'];
                $invoice_date=date('Y-m-d',strtotime($_POST['invoice_date']));
                $cname= mysqli_real_escape_string($con,$_POST['cname']) ;
                $caddress= mysqli_real_escape_string($con,$_POST['caddress']) ;
                $ccity= mysqli_real_escape_string($con,$_POST['ccity']) ;
                $mobile= mysqli_real_escape_string($con,$_POST['mobile']) ;
                $grand_total= mysqli_real_escape_string($con,$_POST['grand_total']) ;


                $sql="INSERT INTO  invoice (INVOICE_NO,INVOICE_DATE,CNAME,CADDRESS,CCITY,MOBILE,GRAND_TOTAL) VALUES('{$invoice_no}','{$invoice_date}','{$cname}','{$caddress}','{$ccity}','{$mobile}','{$grand_total}')";
                if($con->query($sql)){
                        $SID=$con->insert_id;
                       
                        $sql2="insert into invoice_prodcuts (SID,PNAME,PRICE,QTY,TOTAL) values";
                        $rows=[];
                        for($i=0;$i<count($_POST['pname']);$i++){
                            $pname= mysqli_real_escape_string($con,$_POST['pname'][$i]) ; 
                            $price= mysqli_real_escape_string($con,$_POST['price'][$i]) ;
                            $qty= mysqli_real_escape_string($con,$_POST['qty'][$i]) ;
                            $total= mysqli_real_escape_string($con,$_POST['total'][$i]) ;
                            $rows[]="('{$SID}','{$pname}','{$price}','{$qty}','{$total}')";
                        }
                        $sql2 .= implode(",",$rows);
                        if($con->query($sql2)){
                            echo '<div class="alert alert-success"> Invoice Added. <a href="printpdf.php? printid='.$row['SID'].'  ">Click</a> </div>';
                        }else{
                            echo "<div class='alert alert-danger'> Invoice Added Failed</div>";
                        }
                }else{
                    echo "<div class='alert alert-danger'> Invoice Added Failed</div>";
 
                }

            }
            ?>
            
       <form action="index.php" method="POST" autocomplete="off">
            <div class="row"> 
                    <div class="col-md-4">
                        <h5 class="text-success">Invoice Details</h5>
                        <div class="form-group">
                            <label for="">Invoice No</label>
                            <input type="text" name="invoice_no" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Invoice Date</label>
                            <input type="text" name="invoice_date" id="date" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8"> 
                    <h5 class="text-success">Customer Details</h5>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="cname" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="caddress" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" name="ccity" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" name="mobile" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <h5 class="text-success">Product Details</h5>
                    <table class="table table-bordered">
                    <thead> 
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='product_tbody'>
                        <tr>
                            <td><input type="text" required name="pname[]" class="form-control"></td>
                            <td><input type="text" required name="price[]" class="form-control price"></td>
                            <td><input type="text" required name="qty[]" class="form-control qty"></td>
                            <td><input type="text" required name="total[]" class="form-control total"></td>
                            <td><input type="button" value="X" class="btn btn-danger btn-sm btn-row-remove"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                      <tr class="new">
                        <td><input type="button" value="+Add Row" class=" btn btn-primary btn-sm" id=btn-add-row></td>
                        <td colspan="2"><a colspan="2"> Total</a></td>
                        <td><input type="text" name="grand_total" id="grand_total" class="form-control" required></td>
                        <td></td>
                      </tr>
                    </tfoot>
                    </table>
                    <input type="submit" name="submit" value="Save Invoice" class="btn btn-success float-right">
                    </div>
                </div>
       </form>
    </div>
    <script>
        $(document).ready(function(){
            $("#date").datepicker({
                dateFormat:"dd-mm-yy"
            });
            $("#btn-add-row").click(function(){
            var row ="<tr><td><input type='text' required name='pname[]' class='form-control'></td> <td><input type='text' required name='price[]' class='form-control price'></td><td><input type='text' required name='qty[]' class='form-control qty'> </td><td><input type='text' required name='total[]' class='form-control total'></td> <td><input type='button' value='X' class='btn btn-danger btn-sm btn-row-remove'></td></tr>";
            $("#product_tbody").append(row);
             });
             
        $("body").on("click",".btn-row-remove",function(){
           if(confirm("Are You sure?")){
            $(this).closest("tr").remove();
            grand_total()
           }
        });
        $("body").on("keyup",".price",function(){
            var price=Number($(this).val()); 
            var qty =Number($(this).closest("tr").find(".qty").val());
            $(this).closest("tr").find(".total").val(price*qty);
            grand_total()
        });
        $("body").on("keyup",".qty",function(){
            var qty=Number($(this).val());
            var price =Number($(this).closest("tr").find(".price").val());
            $(this).closest("tr").find(".total").val(price*qty);
            grand_total()
        });
        function grand_total(){
            var tot=0;
            $(".total").each(function(){
                tot+=Number($(this).val());
            });
            $("#grand_total").val(tot);
        }
             

        });

        

        
    </script>

    
</body>
</html> 



