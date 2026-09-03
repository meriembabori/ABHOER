@extends('layouts.responsable')

@section('title', 'Notifications')

@section('page-title', 'Notifications')
@section('page-description', 'Suivez les mises à jour concernant les demandes de stage.')

@section('content')

@php
    $notifications = $notifications ?? collect();
@endphp

<div class="card">

    <div class="card-header bg-transparent border-0 p-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <div>
                <h5 class="fw-bold mb-1">Mes notifications</h5>
                <p class="text-secondary small mb-0">
                    {{ $notificationsNonLues ?? 0 }}
                    @if(($notificationsNonLues ?? 0) > 1)
                        notifications non lues
                    @else
                        notification non lue
                    @endif
                </p>
            </div>

            @if(($notificationsNonLues ?? 0) > 0)

                <form method="POST" action="{{ route('responsable.notifications.lire-toutes') }}">

                    @csrf

                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-check2-all me-1"></i>
                        Tout marquer comme lu
                    </button>

                </form>

            @endif

        </div>

    </div>

    <div class="card-body p-4">

        @if($notifications->count() > 0)

            @foreach($notifications as $notification)

                <div class="border-bottom py-3 {{ !$notification->lu ? 'rounded px-3' : '' }}"
                     style="{{ !$notification->lu ? 'background: rgba(0,217,208,.06);' : '' }} border-color: var(--resp-border) !important;">

                    <div class="d-flex align-items-start">

                        <div class="me-3">
                            <div
                                class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:45px;height:45px;
                                    {{ $notification->lu
                                        ? 'background: rgba(255,255,255,.08); color: var(--resp-muted);'
                                        : 'background: rgba(0,217,208,.18); color: var(--aqua-cyan);' }}"
                            >
                                @if($notification->type === 'SUCCESS')
                                    <i class="bi bi-check-circle"></i>
                                @elseif($notification->type === 'WARNING')
                                    <i class="bi bi-exclamation-triangle"></i>
                                @elseif($notification->type === 'DANGER')
                                    <i class="bi bi-x-circle"></i>
                                @else
                                    <i class="bi bi-bell"></i>
                                @endif
                            </div>
                        </div>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between align-items-start">

                                <h6 class="fw-bold mb-1">
                                    {{ $notification->titre ?? 'Notification' }}
                                    @if(!$notification->lu)
                                        <span class="badge bg-primary ms-2">Nouvelle</span>
                                    @endif
                                </h6>

                                @if(!$notification->lu)

                                    <form method="POST" action="{{ route('responsable.notifications.lire', $notification->idNotification) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Marquer comme lue">
                                            <i class="bi bi-check2"></i>
                                        </button>
                                    </form>

                                @endif

                            </div>

                            <p class="text-secondary mb-1">{{ $notification->message ?? '' }}</p>

                            @if($notification->created_at)
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $notification->created_at->format('d/m/Y à H:i') }}
                                </small>
                            @endif

                            @if($notification->idDemande)
                                <div class="mt-2">
                                    <a href="{{ route('responsable.demandes.show', $notification->idDemande) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i>
                                        Voir la demande
                                    </a>
                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        @else

            <div class="text-center py-5">

                <div
                    class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4"
                    style="width:80px;height:80px; background: rgba(0,217,208,.14); color: var(--aqua-cyan);"
                >
                    <i class="bi bi-bell-slash" style="font-size:32px;"></i>
                </div>

                <h5 class="fw-bold mb-2">Aucune notification</h5>
                <p class="text-secondary mb-4">Vous n'avez aucune notification pour le moment.</p>

                <a href="{{ route('responsable.dashboard') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-2"></i>
                    Retour au tableau de bord
                </a>

            </div>

        @endif

    </div>

</div>

@endsection
