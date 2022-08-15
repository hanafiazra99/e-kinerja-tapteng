ALTER VIEW `cv_simpeg_laporan_agama` AS
SELECT
    `a`.`id` AS `id`,
    `a`.`nama` AS `nama`,
    `b`.`label` AS `status_kepegawaian`,
    `c`.`nama` AS `opd`,
    `d`.`label` AS `agama`,
    g.label AS jenis_kelamin,
    `e`.`label` AS `kedudukan_pegawai`,
    `f`.`nip` AS `nip`
FROM
    (
        (
            (
                (
                    (
                        (
                            `mily7_ekinerja_new`.`pegawai` `a`
                            LEFT JOIN `mily7_ekinerja_new`.`ref_status_kepegawaian` `b` ON ((`a`.`status_kepegawaian` = `b`.`id`))
                        )
                        LEFT JOIN `mily7_ekinerja_new`.`opd` `c` ON ((`a`.`opd` = `c`.`id`))
                    )
                    LEFT JOIN `mily7_ekinerja_new`.`ref_agama` `d` ON ((`a`.`agama` = `d`.`id`))
                )
                LEFT JOIN `mily7_ekinerja_new`.`ref_kedudukan_pegawai` `e` ON ((`a`.`kedudukan_pegawai` = `e`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `f` ON ((`a`.`id` = `f`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`ref_jenis_kelamin` `g` ON ((`g`.`id` = `a`.`jenis_kelamin`))
    )
WHERE
    (`e`.`label` = 'Aktif')
ORDER BY
    `b`.`id`,
    `c`.`id`,
    `d`.`id`;

ALTER VIEW `cv_simpeg_laporan_opd` AS
SELECT
    `a`.`id` AS `id`,
    `a`.`nama` AS `nama`,
    `b`.`label` AS `status_kepegawaian`,
    `c`.`nama` AS `opd`,
    `d`.`nama` AS `unit_organisasi`,
    `e`.`label` AS `kedudukan_pegawai`,
    `f`.`nip` AS `nip`,
    g.label AS jenis_kelamin
FROM
    (
        (
            (
                (
                    (
                        `mily7_ekinerja_new`.`pegawai` `a`
                        LEFT JOIN `mily7_ekinerja_new`.`ref_status_kepegawaian` `b` ON ((`a`.`status_kepegawaian` = `b`.`id`))
                    )
                    LEFT JOIN `mily7_ekinerja_new`.`opd` `c` ON ((`a`.`opd` = `c`.`id`))
                )
                LEFT JOIN `mily7_ekinerja_new`.`opd_unit_organisasi` `d` ON ((`a`.`unit_organisasi` = `d`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`ref_kedudukan_pegawai` `e` ON ((`a`.`kedudukan_pegawai` = `e`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `f` ON ((`a`.`id` = `f`.`id`))
    )
    LEFT JOIN ref_jenis_kelamin g ON g.id = a.jenis_kelamin
WHERE
    (`e`.`label` = 'Aktif')
ORDER BY
    `b`.`id`,
    `c`.`id`,
    `d`.`id`;

ALTER VIEW `cv_simpeg_laporan_pendidikan_terakhir` AS
SELECT
    `a`.`id` AS `id`,
    `a`.`nama` AS `nama`,
    `b`.`label` AS `status_kepegawaian`,
    `c`.`nama` AS `opd`,
    (
        SELECT
            `get_pegawai_pendidikan_terakhir`(`a`.`id`)
    ) AS `pendidikan_terakhir`,
    `d`.`label` AS `kedudukan_pegawai`,
    `e`.`nip` AS `nip`,
    f.label AS jenis_kelamin
FROM
    (
        (
            (
                (
                    `mily7_ekinerja_new`.`pegawai` `a`
                    LEFT JOIN `mily7_ekinerja_new`.`ref_status_kepegawaian` `b` ON ((`a`.`status_kepegawaian` = `b`.`id`))
                )
                LEFT JOIN `mily7_ekinerja_new`.`opd` `c` ON ((`a`.`opd` = `c`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`ref_kedudukan_pegawai` `d` ON ((`a`.`kedudukan_pegawai` = `d`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `e` ON ((`a`.`id` = `e`.`id`))
    )
    LEFT JOIN ref_jenis_kelamin f ON f.id = a.jenis_kelamin
WHERE
    (`d`.`label` = 'Aktif')
ORDER BY
    `b`.`id`,
    `c`.`id`,
    (
        SELECT
            `get_pegawai_pendidikan_terakhir`(`a`.`id`)
    );

ALTER VIEW `cv_simpeg_laporan_pgr` AS
SELECT
    `a`.`id` AS `id`,
    `a`.`nama` AS `nama`,
    `b`.`label` AS `status_kepegawaian`,
    `c`.`nama` AS `opd`,
    CONCAT(
        `e`.`pangkat`,
        '/',
        `e`.`golongan`,
        '/',
        `e`.`ruang`
    ) AS `pgr`,
    `f`.`label` AS `kedudukan_pegawai`,
    `g`.`nip` AS `nip`,
    `h`.`label` AS `jenis_kelamin`
FROM
    (
        (
            (
                (
                    (
                        (
                            (
                                `mily7_ekinerja_new`.`pegawai` `a`
                                LEFT JOIN `mily7_ekinerja_new`.`ref_status_kepegawaian` `b` ON ((`a`.`status_kepegawaian` = `b`.`id`))
                            )
                            LEFT JOIN `mily7_ekinerja_new`.`opd` `c` ON ((`a`.`opd` = `c`.`id`))
                        )
                        LEFT JOIN `mily7_ekinerja_new`.`pegawai_pgr` `d` ON ((`a`.`id` = `d`.`id`))
                    )
                    LEFT JOIN `mily7_ekinerja_new`.`ref_pgr` `e` ON ((`d`.`pgr` = `e`.`id`))
                )
                LEFT JOIN `mily7_ekinerja_new`.`ref_kedudukan_pegawai` `f` ON ((`a`.`kedudukan_pegawai` = `f`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `g` ON ((`a`.`id` = `g`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`ref_jenis_kelamin` `h` ON ((`h`.`id` = `a`.`jenis_kelamin`))
    )
WHERE
    (
        (`a`.`status_kepegawaian` <> 3)
        AND(`f`.`label` = 'Aktif')
    )
ORDER BY
    `b`.`id`,
    `c`.`id`,
    `e`.`golongan` DESC,
    `e`.`ruang` DESC;

ALTER VIEW `cv_simpeg_laporan_jenis_kepegawaian` AS
SELECT
    `a`.`id` AS `id`,
    `a`.`nama` AS `nama`,
    `b`.`label` AS `status_kepegawaian`,
    `c`.`nama` AS `opd`,
    `e`.`label` AS `jenis_kepegawaian`,
    `f`.`label` AS `kedudukan_pegawai`,
    `d`.`nip` AS `nip`,
    g.label AS jenis_kelamin
FROM
    (
        (
            (
                (
                    (
                        `mily7_ekinerja_new`.`pegawai` `a`
                        LEFT JOIN `mily7_ekinerja_new`.`ref_status_kepegawaian` `b` ON ((`a`.`status_kepegawaian` = `b`.`id`))
                    )
                    LEFT JOIN `mily7_ekinerja_new`.`opd` `c` ON ((`a`.`opd` = `c`.`id`))
                )
                LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `d` ON ((`a`.`id` = `d`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`ref_jenis_kepegawaian` `e` ON ((`d`.`jenis_kepegawaian` = `e`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`ref_kedudukan_pegawai` `f` ON ((`a`.`kedudukan_pegawai` = `f`.`id`))
    )
    LEFT JOIN ref_jenis_kelamin g ON g.id = a.jenis_kelamin
WHERE
    (
        (`a`.`status_kepegawaian` <> 3)
        AND(`f`.`label` = 'Aktif')
    )
ORDER BY
    `b`.`id`,
    `c`.`id`,
    `e`.`label`;

CREATE VIEW v_simpeg_lp_mutasi_kgb_new AS
SELECT
    v_pegawai_kgb.*
FROM
    `v_pegawai_kgb`
    LEFT JOIN v_simpeg_lp_mutasi_kgb ON v_pegawai_kgb.id = v_simpeg_lp_mutasi_kgb.pegawai_id;

ALTER VIEW `v_simpeg_lp_cuti` AS
SELECT
    `a`.`id` AS `id`,
    `b`.`id` AS `opd_asal_id`,
    `b`.`nama` AS `opd_asal_nama`,
    `c`.`id` AS `pegawai_id`,
    `c`.`nama` AS `pegawai_nama`,
    `d`.`nip` AS `pegawai_nip`,
    `a`.`jenis_cuti` AS `jenis_cuti`,
    `a`.`tgl_mulai` AS `tgl_mulai`,
    `a`.`tgl_selesai` AS `tgl_selesai`,
    `a`.`pyb` AS `pyb`,
    `a`.`no_sk` AS `no_sk`,
    `a`.`tgl_sk` AS `tgl_sk`,
    `a`.`file_sk` AS `file_sk`,
    `a`.`keterangan` AS `keterangan`,
    `a`.`ts` AS `ts`,
    `a`.`tr` AS `tr`,
    `a`.`status` AS `status`,
    `a`.`alasan` AS `alasan`,
    CONCAT(
        `f`.`pangkat`,
        '/',
        `f`.`golongan`,
        '/',
        `f`.`ruang`
    ) AS `pgr`
FROM
    (
        (
            (
                `mily7_ekinerja_new`.`simpeg_lp_cuti` `a`
                LEFT JOIN `mily7_ekinerja_new`.`opd` `b` ON ((`a`.`opd_asal` = `b`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`pegawai` `c` ON ((`a`.`pegawai` = `c`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `d` ON ((`a`.`pegawai` = `d`.`id`))
    )
    LEFT JOIN pegawai_pgr e ON a.id = e.id
    LEFT JOIN ref_pgr f ON f.id = e.pgr
    
ALTER TABLE
    `simpeg_lp_cuti`
ADD
    `nama_pyb` VARCHAR(255) NULL
AFTER
    `pyb`,
ADD
    `nip_pyb` VARCHAR(255) NULL
AFTER
    `nama_pyb`;

ALTER TABLE
    `simpeg_lp_mutasi_kgb`
ADD
    `nama_pym` VARCHAR(255) NULL
AFTER
    `pym`,
ADD
    `nip_pym` VARCHAR(255) NULL
AFTER
    `nama_pym`;

ALTER VIEW `v_simpeg_lp_cuti` AS
SELECT
    `a`.`id` AS `id`,
    `b`.`id` AS `opd_asal_id`,
    `b`.`nama` AS `opd_asal_nama`,
    `c`.`id` AS `pegawai_id`,
    `c`.`nama` AS `pegawai_nama`,
    `d`.`nip` AS `pegawai_nip`,
    `a`.`jenis_cuti` AS `jenis_cuti`,
    `a`.`tgl_mulai` AS `tgl_mulai`,
    `a`.`tgl_selesai` AS `tgl_selesai`,
    `a`.`pyb` AS `pyb`,
    `a`.`nama_pyb` AS `nama_pyb`,
    `a`.`nip_pyb` AS `nip_pyb`,
    `a`.`no_sk` AS `no_sk`,
    `a`.`tgl_sk` AS `tgl_sk`,
    `a`.`file_sk` AS `file_sk`,
    `a`.`keterangan` AS `keterangan`,
    `a`.`ts` AS `ts`,
    `a`.`tr` AS `tr`,
    `a`.`status` AS `status`,
    `a`.`alasan` AS `alasan`,
    (
        TO_DAYS(`a`.`tgl_selesai`) - TO_DAYS(`a`.`tgl_mulai`)
    ) AS `lama`,
    CONCAT(
        `f`.`pangkat`,
        '/',
        `f`.`golongan`,
        '/',
        `f`.`ruang`
    ) AS `pgr`
FROM
    (
        (
            (
                (
                    (
                        `mily7_ekinerja_new`.`simpeg_lp_cuti` `a`
                        LEFT JOIN `mily7_ekinerja_new`.`opd` `b` ON ((`a`.`opd_asal` = `b`.`id`))
                    )
                    LEFT JOIN `mily7_ekinerja_new`.`pegawai` `c` ON ((`a`.`pegawai` = `c`.`id`))
                )
                LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `d` ON ((`a`.`pegawai` = `d`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`pegawai_pgr` `e` ON ((`a`.`id` = `e`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`ref_pgr` `f` ON ((`f`.`id` = `e`.`pgr`))
    );

ALTER VIEW `v_simpeg_lp_mutasi_kgb` AS
SELECT
    `a`.`id` AS `id`,
    `b`.`id` AS `opd_asal_id`,
    `b`.`nama` AS `opd_asal_nama`,
    `c`.`id` AS `pegawai_id`,
    `c`.`nama` AS `pegawai_nama`,
    `d`.`nip` AS `pegawai_nip`,
    `a`.`pym` AS `pym`,
    `a`.`nama_pym` AS `nama_pym`,
    `a`.`nip_pym` AS `nip_pym`,
    `a`.`no_sk` AS `no_sk`,
    `a`.`tgl_sk` AS `tgl_sk`,
    `a`.`tmt` AS `tmt`,
    `a`.`masa_kerja` AS `masa_kerja`,
    `a`.`kantor_pembayaran` AS `kantor_pembayaran`,
    `a`.`file_sk` AS `file_sk`,
    `a`.`old` AS `old`,
    `a`.`ts` AS `ts`,
    `a`.`tr` AS `tr`,
    `a`.`status` AS `status`,
    `a`.`alasan` AS `alasan`,
    CONCAT(
        `f`.`pangkat`,
        '/',
        `f`.`golongan`,
        '/',
        `f`.`ruang`
    ) AS `pgr`
FROM
    (
        (
            (
                `mily7_ekinerja_new`.`simpeg_lp_mutasi_kgb` `a`
                LEFT JOIN `mily7_ekinerja_new`.`opd` `b` ON ((`a`.`opd_asal` = `b`.`id`))
            )
            LEFT JOIN `mily7_ekinerja_new`.`pegawai` `c` ON ((`a`.`pegawai` = `c`.`id`))
        )
        LEFT JOIN `mily7_ekinerja_new`.`pegawai_asn` `d` ON ((`a`.`pegawai` = `d`.`id`))
    )
    LEFT JOIN pegawai_pgr e ON a.id = e.id
    LEFT JOIN ref_pgr f ON f.id = e.pgr