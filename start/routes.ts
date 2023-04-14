/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| This file is dedicated for defining HTTP routes. A single file is enough
| for majority of projects, however you can define routes in different
| files and just make sure to import them inside this file. For example
|
| Define routes in following two files
| ├── start/routes/cart.ts
| ├── start/routes/customer.ts
|
| and then import them inside `start/routes.ts` as follows
|
| import './routes/cart'
| import './routes/customer'
|
*/

import Route from '@ioc:Adonis/Core/Route'
import Database from '@ioc:Adonis/Lucid/Database'

Route.get('/', async () => {
  return { hello: 'world' }
})

Route.get('/nilai', async () => {
  const nilai = await Database.rawQuery(
    'SELECT perkuliahan.id_perkuliahan, mahasiswa.nim, mahasiswa.nama, matakuliah.nama_mk, matakuliah.kode_mk, perkuliahan.nilai FROM perkuliahan join mahasiswa on (perkuliahan.nim = mahasiswa.nim) join matakuliah on (perkuliahan.kode_mk = matakuliah.kode_mk)'
  )
  return nilai[0]
})

//get nilai mahasiswa by nim
Route.get('/nilai/:nim', async ({ params }) => {
  const nilai = await Database.rawQuery(
    'SELECT perkuliahan.id_perkuliahan, mahasiswa.nim, mahasiswa.nama, matakuliah.nama_mk, perkuliahan.nilai FROM perkuliahan join mahasiswa on (perkuliahan.nim = mahasiswa.nim) join matakuliah on (perkuliahan.kode_mk = matakuliah.kode_mk) where mahasiswa.nim = ?',
    [params.nim]
  )
  return nilai[0]
})

//insert nilai mahasiswa
Route.post('/nilai', async ({ request }) => {
  const data = request.only(['nim', 'kode_mk', 'nilai'])
  const nilai = await Database.table('perkuliahan').insert(data)

  return nilai
})

//update nilai mahasiswa
Route.put('/nilai/:nim/:kode_mk', async ({ request, params }) => {
  const data = request.only(['nilai'])
  const nilai = await Database.from('perkuliahan')
    .where('nim', params.nim)
    .andWhere('kode_mk', params.kode_mk)
    .update(data)

  return nilai
})

//delete nilai mahasiswa
Route.delete('/nilai/:nim/:kode_mk', async ({ params }) => {
  const nilai = await Database.from('perkuliahan')
    .where('nim', params.nim)
    .andWhere('kode_mk', params.kode_mk)
    .delete()

  return nilai
})

//get mahasiswa dan nimnya
Route.get('/mahasiswa', async () => {
  const mahasiswa = await Database.rawQuery('SELECT nim, nama FROM mahasiswa')
  return mahasiswa[0]
})

//get matakuliah dan kode_mknya
Route.get('/matakuliah', async () => {
  const matakuliah = await Database.rawQuery('SELECT kode_mk, nama_mk FROM matakuliah')
  return matakuliah[0]
})
