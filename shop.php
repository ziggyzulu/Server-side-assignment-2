<?php
include ('header.php');
include ('dbHandler.php');
include ('navbar.php');
session_start();

echo ("Welcome to the shop user " . $_SESSION['userID'] );

$stmt = $conn->query("SELECT * FROM product_database");

if(!isset($_COOKIE["user"])) {
    setcookie("user", time(), time() + (86400 * 30), "/"); // 86400 = 1 day
    //$_COOKIE['user_cart'] = array();

}

$_SESSION["user_cart"] = array();

?>

<table style="border: 1px solid black">

    <tr>
        <th>Title</th>
        <th>Price</th>
        <th>Delete</th>
    </tr>
    <?php
    while ($row = $stmt->fetch()) {
        ?>
        <tr id = <?php echo $row['id']; ?>>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo '<img src="images/'  . $row["image"] .  '">';?></td>
            <td><button type="button" id="cart_button">Add to cart</button></td>

        </tr>
        <?php
    }
    ?>
</table>

<script>

    $(document).ready(function() {

        jQuery("button").click(function(){

            var theID = $(this).closest("tr").attr("id");

            jQuery.ajax({

                type:"post",
                dataType:"Text",
                url:"ajax.php",
                data:{"productID":theID},
                beforeSend: function(){

                    alert("sending");
                    alert(theID);

                },

                success: function(data){

                    alert("Added to cart!");

                }

            });

        });

    });


</script>


