<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/assets/css/styles.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
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
                    <h5 style="color:brown">Create New </h5>
                    <div class="form-floating mb-2 w-50 pt-2">
                            <input type="date" class="form-control" id="popDate" placeholder="POP Date" name="popDate" required>
                            <label for="itmName">POP Date</label>
                    </div>
                <h5 class="pt-4">Added Item to Purchase Proposal</h5>
                <table class="table">
                    <thead>
                        <tr>
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
                    <button id="createProposal" class="btn btn-success mt-3 w-50">Create Purchase Order Proposal</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="cardBox">
                <div class="card p-3 pt-3">
                <h5 style="color:brown">Add Item to Proposal</h5>
            <div class="input-group mb-2">
            <select id="item" class="form-control">
                <option value="">Select an item</option>
                <!-- Add inventory items as options here -->
                <option value="item1">Item 1</option>
                <option value="item2">Item 2</option>
                <!-- Add more items as needed -->
            </select>
            <input type="number" id="price" class="form-control" placeholder="Price">
            <input type="number" id="quantity" class="form-control" placeholder="Quantity">
            <div class="input-group-append">
                <button id="addItem" class="btn btn-primary">Add to Proposal</button>
            </div>
            </div>
            <script>
    const addItemButton = document.getElementById('addItem');
    const purchaseOrderItems = document.getElementById('purchaseOrderItems');

    addItemButton.addEventListener('click', () => {
      const item = document.getElementById('item').value;
      const price = document.getElementById('price').value;
      const quantity = document.getElementById('quantity').value;

      if (item && price && quantity) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
          <td>${item}</td>
          <td>${price}</td>
          <td>${quantity}</td>
          <td><button class="btn btn-danger" onclick="removeItem(this)">Remove</button></td>
        `;
        purchaseOrderItems.appendChild(newRow);

        // Clear input fields after adding item to proposal
        document.getElementById('item').value = '';
        document.getElementById('price').value = '';
        document.getElementById('quantity').value = '';
      }
    });

    function removeItem(button) {
      const row = button.closest('tr');
      row.remove();
    }

    // Add additional functionality for "Create Purchase Order Proposal" and "Clear All" buttons as needed.
  </script>
</body>
</html>