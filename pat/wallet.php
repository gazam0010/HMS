<?php
require_once 'login_session.php';

include 'header_after_pat.php';
?>


<!DOCTYPE html>
<html>

<head>
    <title>Wallet Management</title>
    <link rel="stylesheet" href="wallet.css">
</head>

<body>
    <div class="wallet-container">

        <!-- Popup Message -->
        <?php
        if (isset($_GET['success'])): ?>

            <div class="popup success" id="popup-container">
                <?php
                $message = $_GET['success'];
                echo "<p>$message</p>";
                ?>
            </div>
        <?php endif; ?>
        <?php

        // Validate and sanitize user input
        if ($connection->connect_error) {
            die('Connection failed: ' . $connection->connect_error);
        }

        // Validate and sanitize user input
        function sanitizeInput($input)
        {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        function validateInt($value)
        {
            return filter_var($value, FILTER_VALIDATE_INT) !== false;
        }


        $stmt = $connection->prepare("SELECT balance FROM patient WHERE pid = ?");
        $stmt->bind_param("i", $pid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $balance = $row['balance'];
            echo '<div class="wallet-balance">Wallet Balance: ' . $balance . '</div>';
        } else {
            echo '<div class="error-message">No wallet found for the patient.</div>';
        }

        #<---TRANSACTION HISTORY--->
        

        echo '<div class="left-side">
        <div class="transaction-history">
        <h3>Transaction History</h3>
        <div class="transaction-table-container">';

        // Fetch transaction history for the user
        $stmt = $connection->prepare("SELECT * FROM transactions WHERE user_id = ?");
        $stmt->bind_param("i", $pid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $transactions = $result->fetch_all(MYSQLI_ASSOC);

            // Pagination settings
            $perPage = 4; // Number of transactions per page
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $totalTransactions = count($transactions);
            $totalPages = ceil($totalTransactions / $perPage);

            // Validate current page
            if ($currentPage < 1 || $currentPage > $totalPages) {
                $currentPage = 1;
            }

            // Calculate the start and end index of transactions to display
            $startIndex = ($currentPage - 1) * $perPage;
            $endIndex = min($startIndex + $perPage, $totalTransactions);

            echo '<table>';
            echo '<tr>';
            echo '<th>Transaction ID</th>';
            echo '<th>Amount</th>';
            echo '<th>Type</th>';
            echo '<th>Remark</th>';
            echo '</tr>';

            for ($i = $startIndex; $i < $endIndex; $i++) {
                $row = $transactions[$i];
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>' . $row['type'] . '</td>';
                echo '<td>' . $row['remark'] . '</td>';
                echo '</tr>';
            }

            echo '</table></div>';

            // Pagination links
            echo '<div class="pagination">';
            if ($totalPages > 1) {
                if ($currentPage > 1) {
                    echo '<a class="page-link" href="wallet.php?page=' . ($currentPage - 1) . '">Previous</a>';
                }

                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i === $currentPage) {
                        echo '<span class="current-page">' . $i . '</span>';
                    } else {
                        echo '<a class="page-link" href="wallet.php?page=' . $i . '">' . $i . '</a>';
                    }
                }

                if ($currentPage < $totalPages) {
                    echo '<a class="page-link" href="wallet.php?page=' . ($currentPage + 1) . '">Next</a>';
                }
            }
            echo '</div>';
        } else {
            echo '<div class="error-message">No transaction history found.</div>';
        }
        echo '</div></div>';

        ?>
        <div>
            <div class="right-side">
                <h2>Deposit Fund</h2>
                <form class="wallet-form" method="POST" action="pay_gateway.php" onsubmit="return validateForm()">
                    <div class="input-container">
                        <input type="number" id="deposit_amount" name="deposit_amount"
                            placeholder="Enter deposit amount">
                    </div>

                    <div class="deposit-options">
                        <h4>Payment Options</h4>
                        <input type="radio" name="deposit_option" id="upi_option" value="UPI">
                        <label for="upi_option">UPI</label>
                        <br>
                        <input type="radio" name="deposit_option" id="credit_card_option" value="Credit Card" required>
                        <label for="credit_card_option">Credit Card</label>
                        <br>
                        <input type="radio" name="deposit_option" id="debit_card_option" value="Debit Card" required>
                        <label for="debit_card_option">Debit Card</label>
                        <br>
                        <input type="radio" name="deposit_option" id="net_banking_option" value="Net Banking" required>
                        <label for="net_banking_option">Net Banking</label>
                    </div>
                    <input name="deposit" type="submit" value="Deposit">
                </form>
            </div>

        </div>
        <div style="clear:both;"></div>
    </div>

    <script>
        setTimeout(function () {
            var popupContainer = document.getElementById('popup-container');
            popupContainer.style.opacity = '0';
        }, 5000);

        function validateForm() {
            var amountInput = document.getElementById('deposit_amount');
            var amount = amountInput.value;
            if (amount <= 0) {
                alert('Deposit amount must be greater than zero.');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
<?php
include 'footer.php';
?>