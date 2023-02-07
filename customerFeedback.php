<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    input[type=text],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
    </style>
    <title>Feedback</title>
</head>

<body>
    <div class="container">
        <form method="post" action="feedback_submit.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="contact">Contact Information:</label>
                <input type="text" class="form-control" id="contact" name="contact">
            </div>
            <div class="form-group">
                <label for="order_id">Order ID:</label>
                <input type="text" class="form-control" id="order_id" name="order_id">
            </div>
            <div class="form-group">
                <label for="order_feedback">Order Feedback:</label>
                <textarea class="form-control" id="order_feedback" name="order_feedback"></textarea>
            </div>
            <div class="form-group">
                <label for="pickup_experience">Pickup Experience:</label>
                <textarea class="form-control" id="pickup_experience" name="pickup_experience"></textarea>
            </div>
            <div class="form-group">
                <label for="overall_rating">Overall Rating:</label>
                <select class="form-control" id="overall_rating" name="overall_rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comments">Additional Comments:</label>
                <textarea class="form-control" id="comments" name="comments"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>