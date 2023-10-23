<?php require_once("db.php") ?>
<?php

$tickets = $db->query("select u.email,t.id,a.name as airplanename,t.userId,t.seatNumber,t.dateTime,t.price,t.city1Id,t.city2Id,c1.cityName as city1,c2.cityName as city2 from tickets t inner join airplanes a on t.airplaneId = a.id join cities c1 on t.city1Id = c1.id join cities c2 on t.city2Id = c2.id join users u on t.userId = u.id")->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tüm Biletler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>

    </style>
</head>

<body>
    <?php include("header.php") ?>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kullanıcı</th>
                    <th>Uçak</th>
                    <th>Koltuk Numarası</th>
                    <th>Tarih</th>
                    <th>Nereden</th>
                    <th>Nereye</th>
                    <th>Fiyat</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tickets as $ticket) {
                ?>
                    <tr>
                        <td><?php echo $ticket->email ?></td>
                        <td><?php echo $ticket->airplanename ?></td>
                        <td><?php echo $ticket->seatNumber ?></td>
                        <td><?php echo $ticket->dateTime ?></td>
                        <td><?php echo $ticket->city1 ?></td>
                        <td><?php echo $ticket->city2 ?></td>
                        <td><?php echo $ticket->price ?></td>
                        <td>
                            <button onclick="delete_ticket(<?php echo $ticket->id ?>)" class="btn btn-danger">Sil</button>
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
        function delete_ticket(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'İptal işlemi',
                text: "Bu bileti iptal etmek istediğinizden emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'İptal Et',
                cancelButtonText: 'Vazgeç',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "deleteticket.php",
                        method: "POST",
                        data: {
                            id
                        },
                        success: (data) => {
                            swalWithBootstrapButtons.fire(
                                'İptal Edildi!',
                                'Bilet başarılı bir şekilde iptal edildi',
                                'success'
                            )
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