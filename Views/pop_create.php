<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
    
    //sql query for retrive item to the drop down list
    $ReadSql = "SELECT itmNo,itmName,itmPrice FROM item";
    $resItem = $dbConn->executeQuery($ReadSql);

    //sql query for add new POP to database
    /*if(isset($_POST["createProposal"])){
        $popDate = $_POST["popDate"];
        $itmNo = $_POST["itmNo"];
        $itmName = $_POST["itmName"];
        $itmPrice = $_POST["itmPrice"];
        $itmQty = $_POST["itmQty"];
        $popStatus ="Open";
    ?>
        <h1><?php echo $popDate,$itmNo,$itmPrice?> </h1>
    <?php 
        if($popDate !=null && $itmNo !=null && $itmName !=null  && $itmPrice !=null && $itmQty !=null)
        {
            $insert_query = "INSERT INTO item (itmName,itmPrice)
            VALUES ('{$itmName}',{$itmPrice});";
            $insert_result = $dbConn -> executeQuery($insert_query);

        }
        else{
            $insert_result = false;
        }
    if($insert_result)
        {header("location: pop_view.php?add_pop=1");}
    else
        {header("location: pop_view.php?add_pop=0");}
    exit(1);
        
    }*/
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
</head>
<body class="d-flex flex-column h-100">
    <?php include('../Shared/nav_header.php')?>
    <div class="container px-5 py-4">
    <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>
        <h3 class=" mt-3">Create Purchase Order Proposals</h3>
        <p>Create new purchase order proposal</p>
        <div class="row pt-3">
        <div class="col-md-6">
            <div class="cardBox">
                <div class="card p-3 pt-3">
                <form method="POST" action="pop_create.php" class="form-floating" enctype="multipart/form-data">
                    <h5 style="color:brown">Create New </h5>
                    <div class="form-floating mb-2 w-50 pt-2">
                            <input type="date" class="form-control" id="popDate" placeholder="POP Date" name="popDate" required>
                            <label for="POPDate">POP Date</label>
                    </div>
                <h5 class="pt-4">Added Item to Purchase Proposal</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseOrderItems">
                        <!-- Purchase order items will be dynamically added here -->
                    </tbody>
                   
                </table>
                    <button id="createProposal" name="createProposal" class="btn btn-success mt-3 w-50" type="submit">Create Purchase Order Proposal</button>
                </form>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="cardBox">
                <div class="card p-3 pt-3">
                <h5 style="color:brown">Add Item to Proposal</h5>
            <div class="input-group mb-2">
            <select id="item" class="form-control">
                <?php
					if ($resItem->num_rows > 0) {
						while ($r = $resItem->fetch_assoc()) {
                    echo '<option value="' . $r['itmNo'] . '" data-price="'. $r['itmPrice'] . '" data-name="' . $r['itmName'] . '">' . $r['itmName'] . '</option>';

				    } } ?>
            </select>
            <input type="number" id="price" class="form-control" placeholder="Price" readonly>
            <input type="number" id="quantity" class="form-control" placeholder="Quantity">
            <div class="input-group-append">
                <button id="addItem" class="btn btn-primary">Add to Proposal</button>
            </div>
            </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        const addItemButton = document.getElementById('addItem');
        const purchaseOrderItems = document.getElementById('purchaseOrderItems');

        addItemButton.addEventListener('click', () => {
            const selectedOption = document.getElementById('item').options[document.getElementById('item').selectedIndex];
            const itmName = selectedOption.dataset.name;
            const item = document.getElementById('item').value;
            //const itemName= document.getElementById('itemNameDisplay').textContent;
            const price = document.getElementById('price').value;
            const quantity = document.getElementById('quantity').value;

        if (item && price && quantity) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                                <td name="itmNo">${item}</td>
                                <td name="itmName">${itmName}</td>
                                <td name="itmPrice">${price}</td>
                                <td name="itmQty">${quantity}</td>
                                <td><i class="bi bi-trash3" onclick="removeItem(this)"></i></td>
                                `;
            purchaseOrderItems.appendChild(newRow);
            // Clear input fields after adding item to proposal
            document.getElementById('item').value = '';
            document.getElementById('price').value = '';
            document.getElementById('quantity').value = '';
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
        var selectedPrice = $(this).find(":selected").data("price");
        
        // Set the selected price in the price input box
        $("#price").val(selectedPrice);
    });
});
    
  </script>
</body>
</html>