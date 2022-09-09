<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./create.php" method="post">
        <input type="text" name="name">
        <input type="text" name="category">
        <input type="text" name="detail">
        <input type="text" name="date">
        <input type="text" name="id">
        <input type="submit">
    </form>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                id: form['id'].value,
            }
            console.log(data);

            axios.delete('http://localhost/api/controller/event/delete.php', {
                data: data
            });
        })
    </script>
</body>

</html>