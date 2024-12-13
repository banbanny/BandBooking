<?php
    include("php/catering_db.php");

    // Prepare and execute the query to fetch customer details
    $stmt = $db->prepare("SELECT id, email, password, full_name, address, contact_number, role FROM orders");
    $stmt->execute();
    
    // Fetch all customer data
    $customer_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Kuya Card's Catering</title>
    <style>
      body {
        display: flex;
        height: 100vh;
        margin: 0;
        overflow: hidden;
        background-color: #f4f4f4;
      }

      .sidebar {
        width: 250px;
        background-color: #343a40;
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-top: 20px;
        position: fixed;
        height: 100%;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
      }

      .sidebar:hover {
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
      }

      .profile-image img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-left: 20px;
      }

      .sidebar-nav .nav-link {
        color: #adb5bd;
        padding: 10px 20px;
        font-size: 16px;
        text-align: left;
        width: 100%;
        border-radius: 5px;
        transition: all 0.2s ease;
      }

      .sidebar-nav .nav-link.active,
      .sidebar-nav .nav-link:hover {
        background-color: #495057;
        color: #fff;
      }

      .main-content {
        margin-left: 250px;
        padding: 20px;
        flex: 1;
        overflow-y: auto;
      }

      .content-page {
        display: none;
      }

      .content-page.active {
        display: block;
      }

      /* Style for table headers */
      table thead th {
        background-color: lightblue !important;
      }
      


    </style>
  </head>
  <body>
    <div class="sidebar">
      <div class="profile-section text-start">
        <div class="profile-image">
          <img
            src="https://via.placeholder.com/80"
            alt="Profile"
            class="rounded-circle"
          />
        </div>
        <h5 class="text-white mt-2 ms-3">Admin</h5>
      </div>
      <nav class="nav flex-column sidebar-nav mt-3">
        <a href="#package" class="nav-link active" data-page="package">Package Products</a>
        <a href="#staff" class="nav-link" data-page="staff">Staff</a>
        <a href="#customers" class="nav-link" data-page="customers">Customer's Info</a>
        <a href="#orders" class="nav-link" data-page="orders">Orders</a>
        <a href="#logout" class="nav-link text-danger" data-page="logout">Logout</a>
      </nav>
    </div>
    <div class="main-content">
      <div id="package" class="content-page active">
        <h1 class="text-center mb-4">Package Products</h1>
        <div class="container">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>PACKAGE TYPE</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Basic Package</td>
                <td>Includes 3 viands and rice.</td>
                <td>$50</td>
                <td>
                  <button class="btn btn-primary btn-sm edit-btn" data-id="1">Edit</button>
                  <button class="btn btn-danger btn-sm delete-btn" data-id="1">Delete</button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Premium Package</td>
                <td>Includes 5 viands, rice, and dessert.</td>
                <td>$80</td>
                <td>
                  <button class="btn btn-primary btn-sm edit-btn" data-id="2">Edit</button>
                  <button class="btn btn-danger btn-sm delete-btn" data-id="2">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div id="staff" class="content-page">
  <h1 class="text-center mb-4">Staff</h1>

<!-- Staff Table -->
<div class="container mt-3">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>STAFF ID</th>
        <th>NAME</th>
        <th>POSITION</th>
        <th>CONTACT</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        // Prepare and execute the query
        $stmt = $db->prepare("SELECT * FROM users WHERE role = 'admin'");
        $stmt->execute();
        
        // Fetch all results as an associative array
        $staff_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Iterate through the results and display in table rows
        foreach ($staff_results as $sresult) {
          echo '<tr>
                  <td>' . htmlspecialchars($sresult['id']) . '</td>
                  <td>' . htmlspecialchars($sresult['full_name']) . '</td>
                  <td>' . htmlspecialchars($sresult['role']) . '</td>
                  <td>' . htmlspecialchars($sresult['contact_number']) . '</td>
                  <td>
                    <button class="btn btn-primary btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                  </td>
                </tr>';
        }
      ?>
    </tbody>
  </table>
</div>


  <!-- Manage Staff Form -->
  <div class="container mt-5">
    <h3 class="text-center mb-4">Manage Staff</h3>
    <div class="card p-3">
      <form id="manageStaffForm">
        <div class="mb-3">
          <label for="staffId" class="form-label">StaffID</label>
          <input type="text" id="staffId" class="form-control" placeholder="Enter Staff ID" />
        </div>
        <div class="mb-3">
          <label for="staffName" class="form-label">Name</label>
          <input type="text" id="staffName" class="form-control" placeholder="Enter Staff Name" />
        </div>
        <div class="mb-3">
          <label for="staffPosition" class="form-label">Position</label>
          <input type="text" id="staffPosition" class="form-control" placeholder="Enter Position" />
        </div>
        <div class="mb-3">
          <label for="staffContact" class="form-label">Contact Details</label>
          <input type="text" id="staffContact" class="form-control" placeholder="Enter Contact Details" />
        </div>
        <div class="text-end">
          <button type="button" class="btn btn-primary me-2">Update</button>
          <button type="button" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="customers" class="content-page">
  <div class="container mt-3">
    <h1 class="text-center mb-4">Customer's Info</h1>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>CUSTOMER ID</th>
          <th>EMAIL ADDRESS</th>
          <th>FULL NAME</th>
          <th>ADDRESS</th>
          <th>CONTACT NUMBER</th>
          <th>ROLE</th>
          <th>ACTIONS</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          // Iterate through the customer results and display in table rows
          foreach ($users as $user) {
            echo '<tr>
                    <td>' . htmlspecialchars($users['id']) . '</td>
                    <td>' . htmlspecialchars($users['email']) . '</td>
                    <td>' . htmlspecialchars($users['full_name']) . '</td>
                    <td>' . htmlspecialchars($users['address']) . '</td>
                    <td>' . htmlspecialchars($users['contact_number']) . '</td>
                    <td>' . htmlspecialchars($users['role']) . '</td>
                    <td>
                      <button class="btn btn-primary btn-sm edit-btn" data-id="' . $users['id'] . '">Edit</button>
                      <button class="btn btn-danger btn-sm delete-btn" data-id="' . $users['id'] . '">Delete</button
                    </td>
                  </tr>';
                  foreach ($orders as $order) {
                    echo '<tr>
                            <td><strong>CUSTOMER ID:</strong> '.$user['id'].'</td>
                        </tr>';
                  }
                  if($order['emai'] != '') {
                    echo '<tr>
                            <td><strong>Mode of Payment:</strong> '.$order['mode_of_payment'].'</td>
                        </tr>';
                    echo '<tr>
                            <td><strong>Reference Number:</strong> '.$order['reference_number'].'</td>
                        </tr>';
                  } else {
                    echo '<tr>
                            <td><strong>Mode of Payment:</strong> Cash on Delivery</td>
                        </tr>';
                  }
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

  </div>
      </div>
      <div id="orders" class="content-page">
  <h1 class="text-center mb-4">Orders</h1>

  <!-- Staff Table -->
  <div class="container mt-3">
  <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>STAFF ID</th>
                <th>NAME</th>
                <th>POSITION</th>
                <th>CONTACT</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <tbody>
        <tr>
          <td>1</td>
          <td>Crissalyn Casuyon</td>
          <td>Admin</td>
          <td>099284724329</td>
          <td>
            <button class="btn btn-primary btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

      <div id="logout" class="content-page">
        <h1>Logout</h1>
        <p>You have successfully logged out.</p>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Package</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <div class="mb-3">
                <label for="editId" class="form-label">ID</label>
                <input type="text" class="form-control" id="editId" readonly />
              </div>
              <div class="mb-3">
                <label for="editType" class="form-label">Package Type</label>
                <input type="text" class="form-control" id="editType" />
              </div>
              <div class="mb-3">
                <label for="editDescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="editDescription" />
              </div>
              <div class="mb-3">
                <label for="editPrice" class="form-label">Price</label>
                <input type="text" class="form-control" id="editPrice" />
              </div>
              <div class="mb-3">
                <label for="editQuantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="editQuantity" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.querySelectorAll('.sidebar-nav .nav-link').forEach((link) => {
        link.addEventListener('click', (e) => {
          e.preventDefault();

          // Remove active class from all links
          document
            .querySelectorAll('.sidebar-nav .nav-link')
            .forEach((navLink) => navLink.classList.remove('active'));

          // Add active class to the clicked link
          link.classList.add('active');

          // Show the corresponding content page
          const pageId = link.getAttribute('data-page');
          document.querySelectorAll('.content-page').forEach((page) => {
            page.classList.remove('active');
          });
          document.getElementById(pageId).classList.add('active');
        });
      });
    </script>
  </body>
</html>