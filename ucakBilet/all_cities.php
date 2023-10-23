<?php require_once("db.php") ?>
<?php

$cities = $db->query("select * from cities")->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tüm Şehirler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>

    </style>
</head>

<body>
    <?php include("header.php") ?>

    <div class="container">
        <a class="btn btn-primary" href="addcity.php">
            Şehir Ekle
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Şehir İsmi</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cities as $city) {
                ?>
                    <tr>
                        <td><?php echo $city->cityName ?></td>
                        <td>
                            <a href="editcity.php?id=<?php echo $city->id ?>" class="btn btn-primary">
                                Düzenle
                            </a>
                        </td>
                        <td>
                            <button onclick="delete_city(<?php echo $city->id ?>)" class="btn btn-danger">Sil</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function delete_city(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Silme işlemi',
                text: "Bu şehri silmek istediğinizden emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sil',
                cancelButtonText: 'Vazgeç',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "deletecity.php",
                        method: "POST",
                        data: {
                            id
                        },
                        success: (data) => {
                            swalWithBootstrapButtons.fire(
                                'Silindi',
                                'Şehir başarılı bir şekilde silindi',
                                'success'
                            )
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        },
                        error: () => {}
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Vazgeçildi',
                        '',
                        'error'
                    )
                }
            })
        }
    </script>
</body>

</html>