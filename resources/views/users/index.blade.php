<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Dashboard API</title>
    <style>
        body{
            padding: 2%;
        }
    </style>
  </head>
  <body>
    @if (session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <table class="table">
        <a class="btn btn-outline-primary" href="{{ route('users.create') }}">Tambah</a>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">FirstName</th>
            <th scope="col">LastName</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($users['data'] as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user['firstName'] }}</td>
                <td>{{ $user['lastName'] }}</td>
                <td>
                    <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-success ">Edit</a>
                    <form class="d-inline-block" action="{{ route('users.destroy', $user['id']) }}" method="POST" onsubmit="return confirm('Are you sure to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak Ada Data</td>
            </tr>
        @endforelse
        </tbody>
      </table>
      @if ($users['total'] > $users['limit'])

    @php $pages = ceil($users['total'] / $users['limit']) @endphp
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ request('page') == 1 || is_null(request('page')) ? 'disabled' : '' }}">
                <a class="page-link" href="?page={{ request('page') ? request('page') - 1 : '1' }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $pages; $i++)
                <li class="page-item {{ request('page') == $i || (is_null(request('page')) && $i == 1) ? 'active' : '' }}"><a class="page-link" href="?page={{ $i }}{{ request('search') ? '&search=' . request('search') : '' }}">{{ $i }}</a></li>
            @endfor
            <li class="page-item {{ request('page') == $pages ? 'disabled' : '' }}">
                <a class="page-link" href="?page={{ request('page') ? request('page') + 1 : $pages - 1 }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>