<div class="modal fade" id="editExpModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 text-start">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Edit Riwayat: {{ $item->position }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.experiences.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Tipe Riwayat <span class="text-danger">*</span></label>
                        <select class="form-select" name="type" required>
                            <option value="experience" {{ $item->type === 'experience' ? 'selected' : '' }}>Pengalaman Kerja</option>
                            <option value="education" {{ $item->type === 'education' ? 'selected' : '' }}>Pendidikan / Akademik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Posisi / Gelar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="position" value="{{ $item->position }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Perusahaan / Universitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company" value="{{ $item->company }}" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Periode Waktu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="period" value="{{ $item->period }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Lokasi</label>
                            <input type="text" class="form-control" name="location" value="{{ $item->location }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Deskripsi Peran / Pencapaian</label>
                        <textarea class="form-control" name="description" rows="3">{{ $item->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Urutan Tampil</label>
                        <input type="number" class="form-control" name="order" value="{{ $item->order }}">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
