-- convert Laravel migrations to raw SQL scripts --

-- migration:2014_10_12_000000_create_users_table --
create table `users` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `email` varchar(255) not null, 
  `role` varchar(255) not null default '3', 
  `subscribed` varchar(255) not null default '0', 
  `email_verified_at` timestamp null, 
  `password` varchar(255) not null, 
  `remember_token` varchar(100) null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB;
alter table 
  `users` 
add 
  unique `users_email_unique`(`email`);

-- migration:2014_10_12_100000_create_password_resets_table --
create table `password_resets` (
  `email` varchar(255) not null, 
  `token` varchar(255) not null, 
  `created_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB;
alter table 
  `password_resets` 
add 
  index `password_resets_email_index`(`email`);

-- migration:2019_08_19_000000_create_failed_jobs_table --
create table `failed_jobs` (
  `id` bigint unsigned not null auto_increment primary key, 
  `connection` text not null, `queue` text not null, 
  `payload` longtext not null, `exception` longtext not null, 
  `failed_at` timestamp default CURRENT_TIMESTAMP not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB;

-- migration:2020_04_06_151120_create_admins_table --
create table `admins` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `email` varchar(255) not null, 
  `role` varchar(255) not null default '1', 
  `email_verified_at` timestamp null, 
  `password` varchar(255) not null, 
  `remember_token` varchar(100) null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB;
alter table 
  `admins` 
add 
  unique `admins_email_unique`(`email`);

-- migration:2020_04_26_105316_create_pdfs_table --
create table `pdfs` (
  `id` bigint unsigned not null auto_increment primary key, 
  `title` varchar(255) null, 
  `autor` varchar(255) null, 
  `is_scanned` varchar(255) null, 
  `is_large_file` varchar(255) not null, 
  `internal_id` varchar(255) not null, 
  `path_to_folder` varchar(255) null, 
  `total_pages` varchar(255) not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB;
alter table 
  `pdfs` 
add 
  unique `pdfs_internal_id_unique`(`internal_id`);
