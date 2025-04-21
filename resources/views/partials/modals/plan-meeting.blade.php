<div class="modal fade" id="planMeetingModal{{ $alert->id }}" tabindex="-1"
    aria-labelledby="planMeetingModalLabel{{ $alert->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="planMeetingModalLabel{{ $alert->id }}">Planifier une
                    Réunion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="planMeetingForm{{ $alert->id }}"
                action="{{ route('meeting.schedule') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="meetingDate{{ $alert->id }}"
                            class="form-label">Date et Heure de la Réunion</label>
                        <input type="datetime-local" class="form-control"
                            id="meetingDate{{ $alert->id }}" name="meetingDate"
                            required>
                    </div>
                    <input type="hidden" name="alert_id"
                        value="{{ $alert->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Planifier</button>
                </div>
            </form>
        </div>
    </div>
</div>