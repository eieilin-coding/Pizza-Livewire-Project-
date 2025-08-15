<h1 align="center">Data user</h1>
<h3 align="center">Date: {{$date}}</h3>
<hr>

<table width="100%" border="1px" style="border-collapse:collapse;">
    <thead>
        
        <tr>
            <th width="10" align="center">No</th>
            <th width="25" align="center">Name</th>
            <th width="35" align="center">Email</th>
            <th width="20" align="center">Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item )
            <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td align="center">{{$item->role}}</td>
        </tr>
        @endforeach
    </tbody>

</table>
