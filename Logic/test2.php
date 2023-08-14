
<!DOCTYPE html>
<html>
<head>
  <title>Purchase Order Proposal</title>
  <link rel="stylesheet" href="../views/assets/css/styles.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-4">
    <h2>Create Purchase Order Proposal</h2>
    <div class="row">
      <!-- Left Half: Select Date and Add Item -->
      <div class="col-md-6">
        <label for="date">Date:</label>
        <input type="date" id="date" class="form-control mb-2">

        <h4>Add Item to Proposal</h4>
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
      </div>

      <!-- Right Half: Added Items -->
      <div class="col-md-6">
        <h4>Added Items</h4>
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
        <button id="createProposal" class="btn btn-success">Create Purchase Order Proposal</button>
        <button id="clearAll" class="btn btn-danger">Clear All</button>
      </div>
    </div>
  </div>

  <!-- Add Bootstrap JS link here -->
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
