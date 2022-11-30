
<?php 
$con=mysqli_connect("localhost","root","","invoice_db");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="new1.css">
</head>
<body>


<div class="container">
                <div class="id">
                    <h2 style="text-align:center">Super Mart!!</h2>
                </div>
 </div>
 <div class="row">
    	
                <div class="cell"> 
                    <h3 class="text-success">Customer Details</h3>
                        <?php 

                               

                                $sql = " SELECT * FROM invoice where SID=5 "  ;
                                $result=mysqli_query($con,$sql);
                                if($result){
                                for($id=0;$row=mysqli_fetch_assoc($result);$id++)
                                {
                                    

                                  
                                    $Name= $row['CNAME'];
                                    $Date = date('d-m-Y',strtotime($row['INVOICE_DATE']));
                                    $City= $row['CCITY'];
                                    $Mobile= $row['MOBILE'];
                                    

                                        echo"
                                        $Name<br>
                                        $Date<br>
                                        $City<br>
                                        $Mobile<br>";
                                
                              
                                }
                                }else{
                                echo "not working";
                                }  

                                ?>
                </div>
    			
                    
                <div class="box " > 
                        <!-- <h3>Summary</h3> -->
                
                        <table style=" padding:50px;" >
                        <h3>Summary</h3>
                            <tr >
                            <th scope="col" style=" text-align: center;padding: 10px;">S.NO</th>
                            <th scope="col" style=" text-align: center;padding: 10x;" >Product</th>
                            <th scope="col" style=" text-align: center;padding: 10px;">Price</th>
                            <th scope="col" style=" text-align: center;padding: 10px;">Qty</th>
                            <th scope="col" style=" text-align: center;padding: 10px;">Total</th>
                            
                            </tr> 
                    
                            <?php

                         $SID=$row['SID'];
                            $sql = " SELECT * FROM invoice_prodcuts  where  SID = 4" ;
                            $result=mysqli_query($con,$sql);
                        
                            if($result){
                            for($id=0;$row=mysqli_fetch_assoc($result);$id++)
                            {
                                
                           
                            $id=$row["SID"];    
                            $Product = $row["PNAME"];
                            $Price = $row["PRICE"];
                            $Qty = $row["QTY"];
                            $Total = $row["TOTAL"];

                            $price = $price + $row["TOTAL"];
                          
                         
                             
                                echo '<tr><td scope="row" style=" text-align: center;padding: 4px;">'.$id.'</td>
                                <td  style=" text-align: center;padding: 20px;">'.$Product.'</td>
                                <td style=" text-align: center;padding: 20px;">'.$Price.'</td>
                                <td style=" text-align: center;padding: 20px;">'.$Qty.'</td>
                                <td style=" text-align: center;padding: 20px;">'.$Total.'</td>
                               
                                
                                

                                </tr>';

                            }
                            }else{
                            echo "not working";
                            }  
                          
                            echo '<tr><th scope="row" style=" text-align: center;padding: 4px;"></th>
                                

                            <td  style=" text-align: center;padding: 20px;"></td>
                            <td style=" text-align: center;padding: 20px;"></td>
                            <td style=" text-align: center;padding: 20px;"> <h4>Grand Total</h4></td>
                            <td style=" text-align: center;padding: 20px;"> '.$price.' </td>
                            </tr>';

                            ?>
                        </table>
                        <!-- <button class="btn btn-primary"><a  class="text-white" href="index.php" name="submit"><i class="fa fa-fw fa-send "></i> BACK</a></button> -->

    	        </div>
 </div>



</body>
</html>





