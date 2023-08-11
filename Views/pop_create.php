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
    if(isset($_POST["createProposal"])){
        $popDate = $_POST["popDate"];
        $popTotal = $_POST["totalAmount"];
        $popStatus ="Open";
        $popItemNos = $_POST["itmNo"];
        $popItemNames = $_POST["itmName"];
        $popItemPrices = $_POST["itmPrice"];
        $popQtys = $_POST["itmQty"];
        

    ?>
    <?php 
        if($popDate !=null && $popTotal !=null && $popItemNos!==null && $popItemNames!==null && $popItemPrices!==null && $popQtys!==null)
        {
            $insert_query = "INSERT INTO pop (popDate,totalamount,status) VALUES ('$popDate',$popTotal,'$popStatus');";
            $insert_result = $dbConn -> executeQuery($insert_query);

            //issue is inth order close
            $ReadSql5 = "SELECT popNo FROM pop  ORDER BY popNo DESC LIMIT 1";
            $resPOList = $dbConn->executeQuery($ReadSql5);

            if ($resPOList->num_rows > 0) {
                while ($r = $resPOList->fetch_assoc()) {
                    $popNo = $r["popNo"];
            }}
            $i=0;
            foreach ($popItemNos as $popItemNo){
 
                $popItemName = $popItemNames[$i];
                $popItemPrice = $popItemPrices[$i];
                $popQty = $popQtys[$i];

                $insert_query2 = "INSERT INTO poplines (popNo,itmNo,itmQty) VALUES ($popNo,$popItemNo,$popQty);";
                $insert_result = $dbConn -> executeQuery($insert_query2);
                $i++; 
            }
        }
        else{
            $insert_result = false;
        }
    if($insert_result)
        {header("location: pop_view.php?add_pop=1");}
    else
        {header("location: pop_view.php?add_pop=0");}
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
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
                <div class="card p-3 pt-3 ">
                <form method="POST" action="pop_create.php" class="form-floating" enctype="multipart/form-data">
                    <h5 class="border-bottom" style="color:black ">Create New </h5>
                    <div class="form-floating mb-2 w-50 pt-2">
                            <input type="date" class="form-control" id="popDate" placeholder="POP Date" name="popDate" required>
                            <label for="POPDate">POP Date</label>
                    </div>
                <h6 class="pt-4 border-bottom">Added Item to Purchase Proposal</h6>
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
                        <input type="hidden" name="totalAmount" id="totalAmount">
                        <h6 class="px-5 pt-3" style="text-align: end; " >Total (Rs.):<span name="itmTotal">0.00</span></h6>
                        <button id="createProposal" name="createProposal" class="btn btn-warning mt-3 w-50" type="submit">Create Purchase Order Proposal</button>
                </form>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="cardBox">
                <div class="card p-3 pt-3">
                <h5 class="border-bottom" style="color:black">Add Item to Proposal</h5>
            <div class="input-group mb-2 mt-4">
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
        let totalAmount =0;
        addItemButton.addEventListener('click', () => {
            const selectedOption = document.getElementById('item').options[document.getElementById('item').selectedIndex];
            const itmName = selectedOption.dataset.name;
            const item = document.getElementById('item').value;
            //const itemName= document.getElementById('itemNameDisplay').textContent;
            const price = document.getElementById('price').value;
            const quantity = document.getElementById('quantity').value;
            totalAmount = totalAmount +(price * quantity);
            updateTotalPrice(totalAmount);

        if (item && price && quantity) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                                <td name="itmNo">${item}</td>
                                <input type="hidden" name="itmNo[]" value="${item}">
                                <td name="itmName">${itmName}</td>
                                <input type="hidden" name="itmName[]" value="${itmName}">
                                <td name="itmPrice">${price}</td>
                                <input type="hidden" name="itmPrice[]" value="${price}">
                                <td name="itmQty">${quantity}</td>
                                <input type="hidden" name="itmQty[]" value="${quantity}">
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
        function updateTotalPrice(totalAmount) {


            // Update the total in the span with name="itmTotal"
            document.querySelector('span[name="itmTotal"]').textContent = totalAmount.toFixed(2);
            document.getElementById('totalAmount').value = totalAmount;

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
    </div>
            </div>
        </div>
        </div>
    </div>
    <div class="flex mt-5">
    <?php include('../Shared/footer.php')?>
  </div>
</body>
</html>