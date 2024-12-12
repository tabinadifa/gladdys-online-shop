<x-layout-admin>
<a href="{{ route('contact.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<form action="{{ route('contact.update') }}" method="POST">
    @csrf
  <div class="mb-3">
    <label for="phone" class="form-label">No. WhatsApp (link)</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" required>
  </div>
  <div class="mb-3">
    <label for="instagram" class="form-label">Instagram (link)</label>
    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $contact->instagram }}" required>
  </div>
  <div class="mb-3">
    <label for="tiktok" class="form-label">TikTok (link)</label>
    <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{ $contact->tiktok }}" required>
  </div>
  <div class="mb-3">
    <label for="twitter" class="form-label">Twitter/X (link)</label>
    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $contact->twitter }}" required>
  </div>
  <div class="mb-3">
    <label for="youtube" class="form-label">YouTube (link)</label>
    <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $contact->youtube }}" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</x-layout-admin>