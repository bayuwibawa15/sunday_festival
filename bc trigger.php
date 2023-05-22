BEGIN
	 IF (new.status='Tidak Setuju') THEN
UPDATE tb_produk SET stok_produk = stok_produk + OLD.jumlah_permintaan
WHERE id_produk = OLD.id_produk;
ELSEIF (new.status='Di Terima') THEN
UPDATE tb_produk SET stok_produk = stok_produk - new.jumlah_permintaan
WHERE id_produk = new.id_produk;
END IF;
END