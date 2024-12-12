<x-layout-admin>
<a href="{{ route('contact.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
<tr>
    <th>E-Mail</th> 
    <td>{{ $contact->email }}</td> 
</tr>
<tr>
    <th>No. WhatsApp</th>
    <td>{{ $contact->phone }}</td>
</tr>
<tr>
    <th>Instagram</th>
    <td>{{ $contact->instagram }}</td>
</tr>
<tr>
    <th>TikTok</th>
    <td>{{ $contact->tiktok }}</td>
</tr>
<tr>
    <th>Twitter/X</th>
    <td>{{ $contact->twitter }}</td>
</tr>
<tr>
    <th>YouTube</th>
    <td>{{ $contact->tiktok }}</td>
</tr>
</table>
</x-layout-admin> 