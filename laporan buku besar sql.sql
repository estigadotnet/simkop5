select
	id,
	rekening,
	tanggal,
	no_tran,
	keterangan,
	debet,
	kredit,
	@st := @st + saldo
from
	(
	select
		r.id ,
		r.rekening ,
		'2019-04-01' as tanggal ,
		'' as no_tran ,
		'Saldo Awal' as keterangan ,
		0 as debet ,
		0 as kredit ,
		saldo
	from
		t91_rekening r

	union

	select
		r.id ,
		r.rekening ,
		case when isnull(j.tanggal) then '2019-04-01' else j.tanggal end as tanggal ,
		j.nomortransaksi as no_tran ,
		j.keterangan as keterangan ,
		case when isnull(j.debet) then 0 else j.debet end as debet ,
		case when isnull(j.kredit) then 0 else j.kredit end as kredit ,
		case when (left(r.id,1) = '2' or left(r.id,1) = '3' or left(r.id,1) = '5')
			then
				(case when isnull(j.kredit) then 0 else j.kredit end - case when isnull(j.debet) then 0 else j.debet end)
			else
				(case when isnull(j.debet) then 0 else j.debet end - case when isnull(j.kredit) then 0 else j.kredit end) end as saldo
	from
		t91_rekening r
		left join t10_jurnal j on r.id = j.rekening
	) bb
	join (select @st := 0) stx
where
	bb.id = '1.2003'
order by
	bb.tanggal 

-- union

-- join (select @st := 0) stx  order by bb.tanggal ;