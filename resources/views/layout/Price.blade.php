@extends('layout.nav')


@section('content')
<main>
    <h1 class="title">Price</h1>
    <ul class="breadcrumbs">
      
        <li class="divider"></li>    </ul>

    <h2 class="mb-4 text-center">Daftar Harga Produk</h2>
   

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Merek</th>
                    <th>Harga dari Produsen (HPP)</th>
                    <th>Harga Jual di Toko</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @php
                    $barangs = [
                        [1,'Nugget Ayam 250g','So Good','Rp12.000','Rp15.600'],
                        [2,'Sosis Ayam 500g','Fiesta','Rp13.500','Rp17.550'],
                        [3,'Sosis Sapi 750g','Champ','Rp15.000','Rp19.500'],
                        [4,'Bakso Sapi 1000g','Bernardi','Rp16.500','Rp21.450'],
                        [5,'Chicken Katsu 250g','So Nice','Rp18.000','Rp23.400'],
                        [6,'Fish Stick 500g','Golden Farm','Rp19.500','Rp25.350'],
                        [7,'Tempura Udang 750g','McCain','Rp21.000','Rp27.300'],
                        [8,'Kentang Goreng Shoestring 1000g','Dapur Solo','Rp22.500','Rp29.250'],
                        [9,'Kentang Goreng Crinkle 250g','So Good','Rp24.000','Rp31.200'],
                        [10,'Siomay Ayam 500g','Fiesta','Rp25.500','Rp33.150'],
                        [11,'Lumpia Mini 750g','Champ','Rp12.000','Rp15.600'],
                        [12,'Cireng Isi Ayam 1000g','Bernardi','Rp13.500','Rp17.550'],
                        [13,'Chicken Wings Spicy 250g','So Nice','Rp15.000','Rp19.500'],
                        [14,'Otak-Otak Ikan 500g','Golden Farm','Rp16.500','Rp21.450'],
                        [15,'Nugget Ayam 750g','McCain','Rp18.000','Rp23.400'],
                        [16,'Sosis Ayam 1000g','Dapur Solo','Rp19.500','Rp25.350'],
                        [17,'Sosis Sapi 250g','So Good','Rp21.000','Rp27.300'],
                        [18,'Bakso Sapi 500g','Fiesta','Rp22.500','Rp29.250'],
                        [19,'Chicken Katsu 750g','Champ','Rp24.000','Rp31.200'],
                        [20,'Fish Stick 1000g','Bernardi','Rp25.500','Rp33.150'],
                        [21,'Tempura Udang 250g','So Nice','Rp12.000','Rp15.600'],
                        [22,'Kentang Goreng Shoestring 500g','Golden Farm','Rp13.500','Rp17.550'],
                        [23,'Kentang Goreng Crinkle 750g','McCain','Rp15.000','Rp19.500'],
                        [24,'Siomay Ayam 1000g','Dapur Solo','Rp16.500','Rp21.450'],
                        [25,'Lumpia Mini 250g','So Good','Rp18.000','Rp23.400'],
                        [26,'Cireng Isi Ayam 500g','Fiesta','Rp19.500','Rp25.350'],
                        [27,'Chicken Wings Spicy 750g','Champ','Rp21.000','Rp27.300'],
                        [28,'Otak-Otak Ikan 1000g','Bernardi','Rp22.500','Rp29.250'],
                        [29,'Nugget Ayam 250g','So Nice','Rp24.000','Rp31.200'],
                        [30,'Sosis Ayam 500g','Golden Farm','Rp25.500','Rp33.150'],
                        [31,'Sosis Sapi 750g','McCain','Rp12.000','Rp15.600'],
                        [32,'Bakso Sapi 1000g','Dapur Solo','Rp13.500','Rp17.550'],
                        [33,'Chicken Katsu 250g','So Good','Rp15.000','Rp19.500'],
                        [34,'Fish Stick 500g','Fiesta','Rp16.500','Rp21.450'],
                        [35,'Tempura Udang 750g','Champ','Rp18.000','Rp23.400'],
                        [36,'Kentang Goreng Shoestring 1000g','Bernardi','Rp19.500','Rp25.350'],
                        [37,'Kentang Goreng Crinkle 250g','So Nice','Rp21.000','Rp27.300'],
                        [38,'Siomay Ayam 500g','Golden Farm','Rp22.500','Rp29.250'],
                        [39,'Lumpia Mini 750g','McCain','Rp24.000','Rp31.200'],
                        [40,'Cireng Isi Ayam 1000g','Dapur Solo','Rp25.500','Rp33.150'],
                        [41,'Chicken Wings Spicy 250g','So Good','Rp12.000','Rp15.600'],
                        [42,'Otak-Otak Ikan 500g','Fiesta','Rp13.500','Rp17.550'],
                        [43,'Nugget Ayam 750g','Champ','Rp15.000','Rp19.500'],
                        [44,'Sosis Ayam 1000g','Bernardi','Rp16.500','Rp21.450'],
                        [45,'Sosis Sapi 250g','So Nice','Rp18.000','Rp23.400'],
                        [46,'Bakso Sapi 500g','Golden Farm','Rp19.500','Rp25.350'],
                        [47,'Chicken Katsu 750g','McCain','Rp21.000','Rp27.300'],
                        [48,'Fish Stick 1000g','Dapur Solo','Rp22.500','Rp29.250'],
                        [49,'Tempura Udang 250g','So Good','Rp24.000','Rp31.200'],
                        [50,'Kentang Goreng Shoestring 500g','Fiesta','Rp25.500','Rp33.150'],
                        [51,'Kentang Goreng Crinkle 750g','Champ','Rp12.000','Rp15.600'],
                        [52,'Siomay Ayam 1000g','Bernardi','Rp13.500','Rp17.550'],
                        [53,'Lumpia Mini 250g','So Nice','Rp15.000','Rp19.500'],
                        [54,'Cireng Isi Ayam 500g','Golden Farm','Rp16.500','Rp21.450'],
                        [55,'Chicken Wings Spicy 750g','McCain','Rp18.000','Rp23.400'],
                        [56,'Otak-Otak Ikan 1000g','Dapur Solo','Rp19.500','Rp25.350'],
                        [57,'Nugget Ayam 250g','So Good','Rp21.000','Rp27.300'],
                        [58,'Sosis Ayam 500g','Fiesta','Rp22.500','Rp29.250'],
                        [59,'Sosis Sapi 750g','Champ','Rp24.000','Rp31.200'],
                        [60,'Bakso Sapi 1000g','Bernardi','Rp25.500','Rp33.150'],
                        [61,'Chicken Katsu 250g','So Nice','Rp12.000','Rp15.600'],
                        [62,'Fish Stick 500g','Golden Farm','Rp13.500','Rp17.550'],
                        [63,'Tempura Udang 750g','McCain','Rp15.000','Rp19.500'],
                        [64,'Kentang Goreng Shoestring 1000g','Dapur Solo','Rp16.500','Rp21.450'],
                        [65,'Kentang Goreng Crinkle 250g','So Good','Rp18.000','Rp23.400'],
                        [66,'Siomay Ayam 500g','Fiesta','Rp19.500','Rp25.350'],
                        [67,'Lumpia Mini 750g','Champ','Rp21.000','Rp27.300'],
                        [68,'Cireng Isi Ayam 1000g','Bernardi','Rp22.500','Rp29.250'],
                        [69,'Chicken Wings Spicy 250g','So Nice','Rp24.000','Rp31.200'],
                        [70,'Otak-Otak Ikan 500g','Golden Farm','Rp25.500','Rp33.150'],
                        [71,'Nugget Ayam 750g','McCain','Rp12.000','Rp15.600'],
                        [72,'Sosis Ayam 1000g','Dapur Solo','Rp13.500','Rp17.550'],
                        [73,'Sosis Sapi 250g','So Good','Rp15.000','Rp19.500'],
                        [74,'Bakso Sapi 500g','Fiesta','Rp16.500','Rp21.450'],
                        [75,'Chicken Katsu 750g','Champ','Rp18.000','Rp23.400'],
                        [76,'Fish Stick 1000g','Bernardi','Rp19.500','Rp25.350'],
                        [77,'Tempura Udang 250g','So Nice','Rp21.000','Rp27.300'],
                        [78,'Kentang Goreng Shoestring 500g','Golden Farm','Rp22.500','Rp29.250'],
                        [79,'Kentang Goreng Crinkle 750g','McCain','Rp24.000','Rp31.200'],
                        [80,'Siomay Ayam 1000g','Dapur Solo','Rp25.500','Rp33.150'],
                        [81,'Lumpia Mini 250g','So Good','Rp12.000','Rp15.600'],
                        [82,'Cireng Isi Ayam 500g','Fiesta','Rp13.500','Rp17.550'],
                        [83,'Chicken Wings Spicy 750g','Champ','Rp15.000','Rp19.500'],
                        [84,'Otak-Otak Ikan 1000g','Bernardi','Rp16.500','Rp21.450'],
                        [85,'Nugget Ayam 250g','So Nice','Rp18.000','Rp23.400'],
                        [86,'Sosis Ayam 500g','Golden Farm','Rp19.500','Rp25.350'],
                        [87,'Sosis Sapi 750g','McCain','Rp21.000','Rp27.300'],
                        [88,'Bakso Sapi 1000g','Dapur Solo','Rp22.500','Rp29.250'],
                        [89,'Chicken Katsu 250g','So Good','Rp24.000','Rp31.200'],
                        [90,'Fish Stick 500g','Fiesta','Rp25.500','Rp33.150'],
                        [91,'Tempura Udang 750g','Champ','Rp12.000','Rp15.600'],
                        [92,'Kentang Goreng Shoestring 1000g','Bernardi','Rp13.500','Rp17.550'],
                        [93,'Kentang Goreng Crinkle 250g','So Nice','Rp15.000','Rp19.500'],
                        [94,'Siomay Ayam 500g','Golden Farm','Rp16.500','Rp21.450'],
                        [95,'Lumpia Mini 750g','McCain','Rp18.000','Rp23.400'],
                        [96,'Cireng Isi Ayam 1000g','Dapur Solo','Rp19.500','Rp25.350'],
                        [97,'Chicken Wings Spicy 250g','So Good','Rp21.000','Rp27.300'],
                        [98,'Otak-Otak Ikan 500g','Fiesta','Rp22.500','Rp29.250'],
                        [99,'Nugget Ayam 750g','Champ','Rp24.000','Rp31.200'],
                        [100,'Sosis Ayam 1000g','Bernardi','Rp25.500','Rp33.150'],
                    ];
                @endphp

                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $barang[0] }}</td>
                        <td>{{ $barang[1] }}</td>
                        <td>{{ $barang[2] }}</td>
                        <td>{{ $barang[3] }}</td>
                        <td>{{ $barang[4] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
