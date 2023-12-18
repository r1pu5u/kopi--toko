$(function() {
    $('.modalUbah').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: 'http://' + location.host + '/public/dashboard/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama-produk').val(data.nama_produk);
                $('#harga').val(data.harga);
                $('#stok_awal').val(data.stok_awal);
                $('#kategori').val(data.kategori);
                $('#keterangan').val(data.keterangan);
                $('#harga_awal').val(data.harga_awal);
                $('#id').val(data.id);
            }
        });
    });

    $('#gUpload').click(function(e) {
        e.preventDefault();
        $('#gambarHidenUpload:hidden').trigger('click');
    });

	$('.addstok').on('click', function() {
		const id = $(this).data('id');
		$('#id-stok').val(id);
	});

    $('.ubahUser').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: 'http://' + location.host + '/public/dashboard/getuser',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama_lengkap').val(data.nama_lengkap);
                $('#username').val(data.username);
                $('#email').val(data.email);
                $('#lokasi').val(data.lokasi);
                $('#id-user').val(data.id);
            }
        });
    });

    $(".checkeble").click(function() { 
        $(this).toggleClass("checked");
    });

    $(".card").click(function() {
        $(this).toggleClass("checks");
    });

    $(".ddd").mouseover(function() {
        $('#pilihan').html('');
    })

    $(".ddd").click(function() {
        var idArray = [];
        var cek = $('.checks');
        cek.each(function(index, item) {
            idArray.push(this.id);

            var is_last_item = (index == (cek.length - 1));
            if (is_last_item) {
                var idSend = JSON.stringify(idArray);
                $.ajax({
                    url: 'http://' + location.host + '/public/dashboard/get_pembebelian',
                    data: { IDs: idSend },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(i, data) {
                            $('#pilihan').append(`
                                <tr>
                                    <td>${data.nama_produk}</td>
                                    <td>${data.harga} K</td>
                                    <td><div class="tmbhh"><i class="fa fa-plus tambahh"></i></div></td>
                                    <td>
						                  <input class="jumlah" name="${data.id}"  value="1" data-harga="${data.harga}" data-id="${data.id}" type="text">
				                    </td>
                                    <td><div class="kurang"><i class="fa fa-minus kurangg"></i></div></td>
                                </tr>`);
                            $('#closeBeli').click(function() {
                                $('#pilihan').html('');    
                            });
                        });
                        
                        var penjharga = [];
                        var valJum = [];
                        var dds = [];
                        const harga = 0;
                        $('.jumlah').keyup(function() {
                            $('.jumlah').each(function(i, value) {
                                // dds.push(eval($(this).data('harga') * $(this).val()));
                                const  data = { 'id': $(this).data('id'), 'harga': eval($(this).data('harga') * $(this).val()) };
                                dds.push(eval($(this).data('harga') * $(this).val()));
                                var len = idArray.length;
                                var final = dds.slice(-len);
                                var total = eval(final.join('+'));

                                $('.total').html(`<p>Rp. ${total}.000</p>`);
                            });
                        });

                        var hargaAwal = [];                        
                        $('.jumlah').each(function(i, value) {
                            hargaAwal.push($(this).data('harga'));
                            var hargaTotalAwal = eval(hargaAwal.join('+'));
                            $('.total').html(`<p>Rp. ${hargaTotalAwal}.000</p>`);
                        });                      

                        $('#penjual tr').each(function(index, item) {
                            penjharga.push($(this).find("td").eq(1).html());
                            valJum.push($(this).find("td").eq(3).html());
                           

                            var lastArr = (index == ($('#penjual tr').length - 1));
                            if (lastArr) {
                                var hargas = penjharga.slice(1);
                                
                            }

			$('.tmbh').each(function(i, value) {
				$(this).css('background-color', 'red');
			});

                            function sumProduct(arrayHarga, arrayValue) {
                                if (arrayHarga.length)
                                    return arrayHarga.pop() * arrayValue() + sumProduct(arrayHarga, arrayValue);
                                return 0;
                            }
                        });

			

                    }
                });
            }

        });
    });

    $(".ingfo").mouseover(function() {
        $('#detail_transaksi').html('');
    })

    $("#laporan-pokok").change(function() {
        var value = $('option:selected', this).data('tanggal');
        $.ajax({
            url: 'http://' + location.host + '/public/dashboard/transaksi_stok',
            data: {tanggal: value},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var dd = [];
                $.each(data.stok, function(index, value) {
                    dd.push(value.harga * value.jumlah);
                })

                var keluar = eval(dd.join('+'));

                var ds = [];
                $.each(data.hasil, function(index, value) {
                    ds.push(value.harga * value.totalTerjual)
                });

                var untung = eval(ds.join('+'));

                var laba = untung - keluar;

                $('#666').html(`
                        <tr>
                            <td>Modal Awal</td>
                            <td>Rp. ${data.toko.modal}.000</td>
                        </tr>
                        <tr>
                            <td>Hasil Penjualan</td>
                            <td>Rp. ${untung}.000</td>
                        </tr>
                        <tr>
                            <td>Pembelian Stok</td>
                            <td>Rp. ${keluar}.000</td>
                        </tr>
                        <tr>
                            <td>Laba Bersih</td>
                            <td>Rp. ${laba}.000</td>
                        </tr>
                    `);
            }
        });
    });

    $('#laporan-produk').change(function() {
    var value = $('option:selected', this).data('tanggal');
        $.ajax({
            url: 'http://' + location.host + '/public/dashboard/transaksi_stok',
            data: {tanggal: value},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#laporan-produk-penjualan').html('');
                $.each(data.hasil, function(i = 1, prdk) {
                    $('#laporan-produk-penjualan').append(`
                        <tr>
                            <td>${i}</td>
                            <td>${prdk.nama_produk}</td>
                            <td>${prdk.kategori}</td>
                            <td>${prdk.harga}</td>
                            <td>${prdk.totalTerjual}</td>
                            <td>${prdk.harga * prdk.totalTerjual}</td>
                        </tr>
                    `);
                })
            }
        });
    });

    $('#kategori-laporan').change(function() {
        var kategori = $('option:selected', this).text();
        $('.laporan-pokok-class:hidden').each(function() {
            $(this).show();
        })
        if (kategori != 'All') {
            $('.laporan-pokok-class').each(function(e) {
                if ($(this).data('kategori') != kategori) {
                    $(this).hide();
                }
            })
        }
    });

    $('.kategori-home').click(function() {
        var kategori = $(this).text();
        $('.laporan-pokok-class:hidden').each(function() {
            $(this).show();
        })
        if (kategori != 'All') {
            $('.laporan-pokok-class').each(function(e) {
                if ($(this).data('kategori') != kategori) {
                    $(this).hide();
                }
            })
        }
    })


    $('#gambarHidenUpload:hidden').change(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#cgambar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);

            }
        }
        readURL(this)
    });

    $('#cari-produk-pembelian').keyup(function() {
        var value = $(this).val().toLowerCase();
        $('.laporan-pokok-class:hidden').each(function() {
            $(this).show();
        });

        if (value.length != 0) {
            $('.ll').each(function(e) {
                if ($(this).text().toLowerCase().indexOf(value) == -1) {
                    $(this).parents('.laporan-pokok-class').hide();
                }
            })
        }
    });

    $('.halaman').click(function(e) {
        e.preventDefault();
        var hal = $(this).data('hal');
        var tanggal = $('#tanggal-transaksi').find(':selected').data('tanggal');

        window.location.href = `/public/dashboard/transaksi/&tanggal=${tanggal}&halaman=${hal}`;
    });

    $('#laporan-pdf').click(function(e) {
        e.preventDefault();
        var hal = $(this).data('hal');
        var tanggal = $('#laporan-pokok').find(':selected').data('tanggal');

        window.location.href = `/public/dashboard/laporan_pdf/${tanggal}`;
    });

    $('#ke-kanan').click(function(e) {
        e.preventDefault();
        var hal = $(this).data('haktif');
        var tanggal = $('#tanggal-transaksi').find(':selected').data('tanggal');

        window.location.href = `/public/dashboard/transaksi/&tanggal=${tanggal}&halaman=${hal + 1}`;
    });

    $('#ke-kiri').click(function(e) {
        e.preventDefault();
        var hal = $(this).data('haktif');
        var tanggal = $('#tanggal-transaksi').find(':selected').data('tanggal');

        window.location.href = `/public/dashboard/transaksi/&tanggal=${tanggal}&halaman=${hal - 1}`;
    })

    $(".ingfo").click(function() {
        const idprdk = $(this).data('idprdk');
        const jml = $(this).data('jml');

        jumlah = jml.split(',');

        $.ajax({
            url: 'http://' + location.host + '/public/dashboard/get_transaksi',
            data: { IDs: idprdk },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, data) {
                    $('#detail_transaksi').append(`
                        <tr>
                            <td>${data.nama_produk}</td>
                            <td>Rp. ${data.harga} K</td>
                            <td>${jumlah[i]}</td>
                            <td>Rp. ${jumlah[i] * data.harga} K</td>
                        </tr>
                        `);
                        $('#closeDetail').click(function() {
                            $('#detail_transaksi').html('');    
                        });
                });
            }
        });
    });

    $('#cari-produk-pembelian-ca').keyup(function(e) {
        e.preventDefault();
        var value = $(this).val();

        $.ajax({
            url: 'http://' + location.host + '/public/contact/cari',
            data: {cari: value},
            method: 'post',
            dataType: 'json',
            success: function(i, data) {
                alert(data)
            }

        })
    })
 

});