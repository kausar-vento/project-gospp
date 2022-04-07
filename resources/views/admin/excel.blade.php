<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Kelamin</th>
            <th>Alamat</th>
           
        </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
    @foreach($excel as $user)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->tampat_lahir}}</td>
            <td>{{ $user->kelamin}}</td>
            <td>{{ $user->alamat}}</td>
            
            
        </tr>
    @endforeach
    </tbody>
</table>