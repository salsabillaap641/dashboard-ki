
@extends('layouts.app')

@section('content')
<style>
    .users-page {
        color: #263750;
        width: 100%;
    }

    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .users-header h2 {
        margin: 0 0 8px;
        font-size: 26px;
        font-weight: 750;
    }

    .users-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .btn-add-user {
        display: inline-block;
        padding: 11px 17px;
        background: #ffc928;
        color: #202a3b;
        text-decoration: none;
        font-weight: 700;
        border-radius: 7px;
        white-space: nowrap;
    }

    .btn-add-user:hover {
        background: #f0b900;
    }

    .users-alert {
        padding: 12px 16px;
        border-radius: 7px;
        margin-bottom: 16px;
        background: #e8f7ed;
        color: #176534;
    }

    .users-alert.error {
        background: #fff0f0;
        color: #b42318;
    }

    .users-table-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 35, 60, .04);
    }

    .users-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .users-table thead {
        background: #344568;
        color: white;
    }

    .users-table th {
        padding: 15px 16px;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
    }

    .users-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #edf0f4;
        font-size: 14px;
        vertical-align: middle;
    }

    .users-table tbody tr:hover {
        background: #f8fafc;
    }

    .users-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-number {
        color: #64748b;
        width: 55px;
    }

    .user-name {
        font-weight: 600;
    }

    .user-username {
        color: #475569;
        white-space: nowrap;
    }

    .role-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #e8eefb;
        color: #344568;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .role-badge.master {
        background: #fff2c2;
        color: #795800;
    }

    .user-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
    }

    .btn-user-edit,
    .btn-user-delete {
        display: inline-block;
        border: 0;
        padding: 7px 11px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-user-edit {
        background: #e8eefb;
        color: #294575;
    }

    .btn-user-edit:hover {
        background: #d8e3fa;
    }

    .btn-user-delete {
        background: #fff0f0;
        color: #b42318;
    }

    .btn-user-delete:hover {
        background: #ffdddd;
    }

    .users-empty {
        padding: 35px !important;
        text-align: center;
        color: #64748b;
    }

    .users-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding: 17px 20px;
        border-top: 1px solid #edf0f4;
    }

    .users-count {
        color: #64748b;
        font-size: 13px;
    }

    .users-pagination nav > div:first-child {
        display: none;
    }

    .users-pagination nav > div:last-child {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }

    .users-pagination nav span,
    .users-pagination nav a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 35px;
        min-height: 35px;
        padding: 7px 11px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
    }

    .users-pagination nav a {
        color: #344568;
        background: white;
    }

    .users-pagination nav a:hover {
        background: #fff5cf;
        border-color: #ffc928;
    }

    .users-pagination nav span[aria-current="page"] {
        background: #344568;
        color: white;
        border-color: #344568;
        font-weight: 700;
    }

    .users-pagination nav span[aria-disabled="true"] {
        color: #a0a9b7;
        background: #f8fafc;
    }

    @media (max-width: 700px) {
        .users-header h2 {
            font-size: 22px;
        }

        .users-footer {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="users-page">
    <div class="users-header">
        <div>
            <h2>Manajemen User</h2>
            <p>Kelola akun pengguna Dashboard Kekayaan Intelektual.</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn-add-user">
            + Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="users-alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="users-alert error">
            {{ session('error') }}
        </div>
    @endif

    <div class="users-table-card">
        <div class="users-table-wrap">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Kabupaten/Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="user-number">
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td class="user-name">
                                {{ $user->name }}
                            </td>

                            <td class="user-username">
                                {{ $user->username }}
                            </td>

                            <td>
                                <span class="role-badge {{ $user->role === 'master' ? 'master' : '' }}">
                                    {{ $user->role === 'master' ? 'Master' : 'Kabupaten/Kota' }}
                                </span>
                            </td>

                            <td>
                                {{ $user->kabupaten->nama_kabupaten ?? '-' }}
                            </td>

                            <td>
                                <div class="user-actions">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="btn-user-edit">
                                        Edit
                                    </a>

                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->username }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-user-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="users-empty">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="users-footer">
            <div class="users-count">
                @if($users->total() > 0)
                    Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }}
                    dari {{ $users->total() }} user
                @else
                    Belum ada user
                @endif
            </div>

            <div class="users-pagination">
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
