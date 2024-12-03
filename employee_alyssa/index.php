<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add or Update employee
    if (isset($_POST['add_employee'])) {
        $name = $_POST['name'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $hire_date = $_POST['hire_date'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Insert data into the database
        $sql = "INSERT INTO employees (name, position, salary, hire_date, email, department, phone, address)
                VALUES ('$name', '$position', '$salary', '$hire_date', '$email', '$department', '$phone', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert success'>New record created successfully</div>";
        } else {
            echo "<div class='alert error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
    
    // Edit employee
    if (isset($_POST['edit_employee'])) {
        $id = $_POST['EmployeeID'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $hire_date = $_POST['hire_date'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Update employee data
        $sql = "UPDATE employees SET name='$name', position='$position', salary='$salary', hire_date='$hire_date', 
                email='$email', department='$department', phone='$phone', address='$address' WHERE EmployeeID=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert success'>Record updated successfully</div>";
        } else {
            echo "<div class='alert error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }

    // Delete employee
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sql = "DELETE FROM employees WHERE EmployeeID=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert success'>Record deleted successfully</div>";
        } else {
            echo "<div class='alert error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            padding: 20px;
            background-color: red;
            color: white;
        }

        h2 {
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        form label {
            flex: 1 1 150px;
            font-weight: bold;
        }

        form input,
        form textarea {
            flex: 2;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form textarea {
            resize: vertical;
        }

        form button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: red;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert.success {
            background-color: red;
            color: white;
        }

        .alert.error {
            background-color: red;
            color: white;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: red;
            color: white;
        }

        td a {
            color: red;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <h1>Employee Management System</h1>

    <div class="container">
        <!-- Employee Form -->
        <h2>Add or Edit Employee</h2>
        <form method="POST">
            <input type="hidden" name="EmployeeID" value="<?= isset($edit_employee) ? $edit_employee['EmployeeID'] : '' ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" value="<?= isset($edit_employee) ? $edit_employee['name'] : '' ?>" required><br>

            <label for="position">Position:</label>
            <input type="text" name="position" value="<?= isset($edit_employee) ? $edit_employee['position'] : '' ?>" required><br>

            <label for="salary">Salary:</label>
            <input type="number" name="salary" value="<?= isset($edit_employee) ? $edit_employee['salary'] : '' ?>" required><br>

            <label for="hire_date">Hire Date:</label>
            <input type="date" name="hire_date" value="<?= isset($edit_employee) ? $edit_employee['hire_date'] : '' ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= isset($edit_employee) ? $edit_employee['email'] : '' ?>" required><br>

            <label for="department">Department:</label>
            <input type="text" name="department" value="<?= isset($edit_employee) ? $edit_employee['department'] : '' ?>" required><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?= isset($edit_employee) ? $edit_employee['phone'] : '' ?>" required><br>

            <label for="address">Address:</label>
            <textarea name="address" required><?= isset($edit_employee) ? $edit_employee['address'] : '' ?></textarea><br><br>

            <?php if (isset($edit_employee)): ?>
                <button type="submit" name="edit_employee">Edit Employee</button>
            <?php else: ?>
                <button type="submit" name="add_employee">Add Employee</button>
            <?php endif; ?>
        </form>
    </div>

    <div class="container">
        <h2>Employee List</h2>
        <table>
            <tr>
                <th>EmployeeID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Email</th>
                <th>Department</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            // Fetch all employees
            $result = $conn->query("SELECT * FROM employees");
            while ($employee = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $employee['EmployeeID'] ?></td>
                    <td><?= $employee['name'] ?></td>
                    <td><?= $employee['position'] ?></td>
                    <td><?= $employee['salary'] ?></td>
                    <td><?= $employee['hire_date'] ?></td>
                    <td><?= $employee['email'] ?></td>
                    <td><?= $employee['department'] ?></td>
                    <td><?= $employee['phone'] ?></td>
                    <td><?= $employee['address'] ?></td>
                    <td>
                        <a href="index.php?edit=<?= $employee['EmployeeID'] ?>">Edit</a> |
                        <a href="index.php?delete=<?= $employee['EmployeeID'] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table
