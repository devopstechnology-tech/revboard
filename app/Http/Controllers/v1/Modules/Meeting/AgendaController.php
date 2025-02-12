<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Modules\Meeting;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Module\Meeting\Agenda;
use App\Http\Requests\CreateAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Http\Requests\CreateSubAgendaRequest;
use App\Http\Requests\UpdateSubAgendaRequest;
use App\Repository\Contracts\AgendaInterface;
use App\Models\Module\Meeting\Agenda\SubAgenda;

class AgendaController extends Controller
{
    public function __construct(private readonly AgendaInterface $agendaRepository)
    {
    }
    public function index(): JsonResponse
    {
        // $this->authorize('viewAny', Agenda::class);
        $agenda = $this->agendaRepository->getAll();

        return $this->response(Response::HTTP_OK, __('messages.records-fetched'), $agenda, Agenda::class);
    }
    public function latestscheduleagendas(): JsonResponse
    {
        // $this->authorize('viewAny', Agenda::class);
        $agendas = $this->agendaRepository->getlatestScheduleAgendas();

        return $this->response(Response::HTTP_OK, __('messages.records-fetched'), $agendas, Agenda::class);
    }
    public function acceptlatestscheduleagendas($oldschedule, $newschedule): JsonResponse
    {
        // $this->authorize('viewAny', Agenda::class);
        $agendas = $this->agendaRepository->AcceptLatestScheduleAgendas($oldschedule, $newschedule);

        return $this->response(Response::HTTP_OK, __('messages.records-fetched'), $agendas, Agenda::class);
    }
    public function scheduleagendas($schedule): JsonResponse
    {
        // $this->authorize('viewAny', Agenda::class);
        $agenda = $this->agendaRepository->getScheduleAgendas($schedule);

        return $this->response(Response::HTTP_OK, __('messages.records-fetched'), $agenda, Agenda::class);
    }

    public function show(Agenda $agenda): JsonResponse
    {
        // $this->authorize('view', [Agenda::class, $agenda->id]);
        $agenda = $this->agendaRepository->get($agenda);

        return $this->response(Response::HTTP_OK, __('messages.record-fetched'), $agenda, Agenda::class);
    }

    public function store(CreateAgendaRequest $request, $schedule): JsonResponse
    {
        // $this->authorize('create', [Agenda::class]);
        $agenda = $this->agendaRepository->create($schedule, $request->validated());

        return $this->response(Response::HTTP_CREATED, __('messages.record-created'), $agenda, Agenda::class);
    }
    public function createsubagenda(CreateSubAgendaRequest $request, $schedule): JsonResponse
    {
        // $this->authorize('create', [Agenda::class]);
        $agenda = $this->agendaRepository->createSubAgenda($schedule, $request->validated());

        return $this->response(Response::HTTP_CREATED, __('messages.record-created'), $agenda, Agenda::class);
    }

    public function update(UpdateAgendaRequest $request, $agenda): JsonResponse
    {

        // $this->authorize('update', [Agenda::class, $agenda->id]);
        $agenda = $this->agendaRepository->update($agenda, $request->validated());

        return $this->response(Response::HTTP_OK, __('messages.record-updated'), $agenda);
    }
    public function updatesubagenda(UpdateSubAgendaRequest $request, $agenda): JsonResponse
    {
        // dd('2', $agenda);
        // $this->authorize('update', [Agenda::class, $agenda->id]);
        $agenda = $this->agendaRepository->updateSubAgenda($agenda, $request->validated());

        return $this->response(Response::HTTP_OK, __('messages.record-updated'), $agenda);
    }

    public function destroy(Agenda $agenda): JsonResponse
    {
        $this->authorize('delete', [Agenda::class, $agenda->id]);
        $this->agendaRepository->delete($agenda);

        return $this->response(Response::HTTP_NO_CONTENT, __('messages.record-deleted'), null);
    }
    public function deleteagenda(Agenda $agenda): JsonResponse
    {
        $this->agendaRepository->deleteagenda($agenda);

        return $this->response(Response::HTTP_NO_CONTENT, __('messages.record-deleted'), null);
    }
    public function deletesubagenda(SubAgenda $subagenda): JsonResponse
    {
        $this->agendaRepository->deletesubagenda($subagenda);

        return $this->response(Response::HTTP_NO_CONTENT, __('messages.record-deleted'), null);
    }
}
