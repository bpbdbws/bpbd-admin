
## API Reference

#### Register Akun

```http
  POST /http://127.0.0.1:8000/api/auth/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. max:255 |
| `no_hp` | `string` | **Required**. max:13 |
| `email` | `string` | **Required**. 'email', 'max:255', 'unique:users' |
| `password` | `string` | **Required**. 'min:8' |
<!-- | `is_google` | `int` | **Required**. 'default:0, 'int', tetap default 0 | -->

#### Login User

```http
  POST /http://127.0.0.1:8000/api/auth/login    
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email/no_hp` | `string` | **Required**. 'string', 'email/no_hp', 'max:13' |
| `password` | `string` | **Required**.  |
| `is_google` | `int` | **Required**.  'default:0|

#### Logout User

```http
  POST /http://127.0.0.1:8000/api/auth/logout
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
<!-- | `is_login` | `int` | **Required**.  'default:0', Ketika logout dari column is_login == 1 menjadi == 0| -->

#### Get User

```http
  GET /http://127.0.0.1:8000/api/profile/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id` | `int` | **Required**.  |

#### Update User

```http
  POST /http://127.0.0.1:8000/api/auth/update-profile/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `file` | `varchar` | **Required**.  test.png|
| `tmpfile` | `varchar` | **Required**.  base64|
| `name` | `varchar` | **Required**.  string|
| `email` | `varchar` | **Required**.  string|
| `no_telp` | `varchar` | **Required**.  string|
| `gender` | `enum` | **Required**.  string l|p|


#### All Bencana

```http
  GET /http://127.0.0.1:8000/api/bencana/
```
#### Notifikasi Bencana

```http
  GET /http://127.0.0.1:8000/api/bencana/{kategori}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `kategori` | `string` | **Required**. 'string', 'default:1', 'max:255', 'default: terbaru dan berdasarkan kategori berita bencana'|

#### Mitigasi Bencana

```http
  GET /http://127.0.0.1:8000/api/mitigasi-bencana/
```

#### Mitigasi Bencana

```http
  GET /http://127.0.0.1:8000/api/mitigasi-bencana/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id` | `int` | **Required**. |

#### Berita

```http
  GET /http://127.0.0.1:8000/api/berita/{kategori}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `kategori` | `string` | **Required**. default:all |


#### Search Berita

```http
  POST /http://127.0.0.1:8000/api/berita
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `judul` | `string` | **Required**. |





