<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $ReadSql = "SELECT i.itemNo as itemNo,i.approvedStock as approvedStock,im.itmName as itmName 
    FROM inventory i,item im where i.itemNo = im.itmNo";
    $resItem = $dbConn->executeQuery($ReadSql);

    if(isset($_POST["allocate"])){
        $aDate = $_POST["aDate"];
        $saleRepNo = $_POST["saleRepNo"];
        $aitmNos = $_POST["itmNo"];
        $aitmQtys = $_POST["itmQty"];
        

    ?>
    <?php 
        if($aDate !=null && $saleRepNo !=null && $aitmNos!==null && $aitmQtys!==null )
        {
            $i=0;
            foreach ($aitmNos as $aitmNo){
                //insert new allocation
                $aitmQty = $aitmQtys[$i];
                $insert_query = "INSERT INTO allocation (saleRepNo,date,itmNo,itmQty) VALUES ($saleRepNo,'$aDate',$aitmNo,$aitmQty);";
                $insert_result = $dbConn -> executeQuery($insert_query);
                //get current stock
                $checkAvailability = "SELECT itemNo,approvedStock FROM inventory where itemNo ='{$aitmNo}' ";
                $resAvailbility = $dbConn->executeQuery($checkAvailability);
                //uodate current stock
                while($rowAvail = $resAvailbility -> fetch_array())
                    {
                        $updateStock = $rowAvail['approvedStock']-$aitmQty;
                        $update_inventory = "UPDATE inventory SET approvedStock = $updateStock  WHERE itemNo = $aitmNo";
                        $update_result_inventory = $dbConn -> executeQuery($update_inventory);
                    }    
                

                $i++; 
            }
        }
        else{
            $insert_result = false;
        }
    if($insert_result && $update_result_inventory){header("location: Inventory_GoodAllocation_View.php?add_allocation=1");}
    else{header("location: Inventory_GoodAllocation_View.php?add_allocation=0");}
    exit(1);
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/assets/css/styles.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <title>Dilma Operations Management System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <?php include('../Shared/nav_header.php')?>
    <div class="container px-5 py-4">
    <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square pe-2"></i>Go back
            </a>
        </div >
        <h3 class="mt-3">Good Allocation</h3>
        <p>Make new good allocation to salesperson</p>
        <div class="row pt-3">
        <div class="col-md-5">
            <div class="cardBox">
                <div class="card p-3 pt-3">
                <form method="POST" action="Inventory_GoodAllocation_add.php" class="form-floating" enctype="multipart/form-data">
                    <h5 class="border-bottom" style="color:black">New Allocation</h5>
                    <div class="form-floating mb-2 w-50 pt-2">
                        <div>
                            <label for="aDate">Allocated Date</label>
                            <input type="date" class="form-control" id="aDate" placeholder="Allocation Date" name="aDate" required>
                            
                        </div>
                        <div class="mt-2">
                            <label for="salespersonl">Select Sales Person </label>
                            <select id="salesperson" name ="saleRepNo" class="form-control">
                                <?php
                                    $ReadSql = "SELECT saleRepNo,salesRepName FROM sales_rep";
                                    $resItems = $dbConn->executeQuery($ReadSql);
                                    if ($resItems->num_rows > 0) {
                                        while ($r = $resItems->fetch_assoc()) {
                                     
                                    echo '<option value="' . $r['saleRepNo'] . '" data-name="' . $r['salesRepName'] . '">' . $r['salesRepName'] . '</option>';

                                    } } ?>
                            </select>
                             
                       
                        </div>
                    </div>
                <h6 class="pt-4 border-bottom">Added Item for allocation</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="allocatbleItems">
                        <!-- Purchase order items will be dynamically added here -->
                    </tbody>
                   
                </table>
                    <button id="allocate" name="allocate" class="btn btn-success mt-3 w-50" type="submit">Allocate</button>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-7 ">
            <div class="cardBox">
                <div class="card p-3 pt-3">
                <h5 class="border-bottom" style="color:black">Add Item to Proposal</h5>
            <div class="input-group mb-2">
            
                <div>
                    <table class="table table-borderless">
                        <thead style="text-align: center;">
                            <th>Item Name</th>
                            <th>Allocatable Quantity</th>
                            <th>Allocating Quantity</th>
                        </thead>
                        <tbody>
                            <tr class="p-3 col-2" >
                                <td><select id="item" class="form-control ">
                                        <?php
                                            if ($resItem->num_rows > 0) {
                                                while ($r = $resItem->fetch_assoc()) {
                                            echo '<option value="' . $r['itemNo'] . '" data-quantity="'. $r['approvedStock'] . '" data-name="' . $r['itmName'] . '">' . $r['itmName'] . '</option>';

                                            } } ?>
                                    </select>
                                </td>
                                <td><input type="number" id="quantity" class="form-control" placeholder="Quantity" readonly></td>
                                <td><input type="number" step="1" min="0.00" id="AlQuantity" class="form-control" placeholder="Quantity" required></td>
                                <td><div class="input-group-append"></td>
                            </tr>
                            <tr>
                                <td><button id="addItem" class="btn btn-primary">Add to list</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        const addItemButton = document.getElementById('addItem');
        const purchaseOrderItems = document.getElementById('allocatbleItems');

        addItemButton.addEventListener('click', () => {
            const selectedOption = document.getElementById('item').options[document.getElementById('item').selectedIndex];
            const itmName = selectedOption.dataset.name;
            const item = document.getElementById('item').value;
            //const itemName= document.getElementById('itemNameDisplay').textContent;
            const price = parseFloat(document.getElementById('quantity').value);
            let quantity = parseFloat(document.getElementById('AlQuantity').value);
            if (quantity>price){
                quantity = price;
            }

        if (item && quantity && AlQuantity) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                                <td name="itmNo">${item}</td>
                                <input type="hidden" name="itmNo[]" value="${item}">
                                <td name="itmName">${itmName}</td>
                                <td name="itmQty">${quantity}</td>
                                <input type="hidden" name="itmQty[]" value="${quantity}">
                                <td><i class="bi bi-trash3" onclick="removeItem(this)"></i></td>
                                `;
            purchaseOrderItems.appendChild(newRow);
            // Clear input fields after adding item to proposal
            document.getElementById('item').value = '';
            document.getElementById('quantity').value = '';
            //document.getElementById('AlQuantity').value = '';
        }
        });

        function removeItem(element) {
        const row = element.closest('tr');
        row.remove();
        //<button class="btn btn-danger" onclick="removeItem(this)">Remove</button>
        }
        //add item price according to item selected
        $(document).ready(function () {
        // Event handler for the dropdown change event
        $("#item").change(function () {
        // Get the selected item's price from the data attribute
        var selectedQuantity = $(this).find(":selected").data("quantity");
        
        // Set the selected price in the price input box
        $("#quantity").val(selectedQuantity);
        $("#AlQuantity").attr("max", selectedQuantity);
    });
});
    
</script>
            </div>
        </div>
        </div>
    </div>
    <div class="flex pt-5 mt-5">
    <?php include('../Shared/footer.php')?>
  </div>
</body>
</html>