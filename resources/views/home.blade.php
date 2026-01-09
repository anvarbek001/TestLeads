@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Leads ') }}<span>{{ Auth()->user()->name . 's' }}</span></div>

                    <div class="card-body">
                        <div class="card_body_item">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                @foreach ($leads as $lead)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $lead->id }}"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                {{ $lead->full_name }} ( {{ $lead->phone }} )
                                                <span
                                                    class="badge  @if ($lead->status == 'new') text-bg-success @elseif($lead->status == 'in_progress') text-bg-warning @else text-bg-danger @endif">{{ $lead->status }}</span>
                                            </button>
                                        </h2>
                                        <div id="collapseTwo{{ $lead->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionPanelsStayOpenExample">
                                            <div class="accordion-body">
                                                <div class="task_buttons">
                                                    <div>Task count: </div>
                                                    <div>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                                            task</button>
                                                    </div>
                                                </div>
                                                @foreach ($lead->tasks as $key => $task)
                                                    <div class="task_body"
                                                        style="background: @if ($task->is_done == 0) red @else green @endif; color:white;">
                                                        <div>
                                                            <h5>{{ $key + 1 }} {{ $task->title }}</h5>
                                                            <span>{{ optional($task->due_at)->format('Y-m-d') ?? 'not deadline' }}</span>
                                                        </div>
                                                        <div class="d-flex align-center">
                                                            <div>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $task->id }}">edit
                                                                    task</button>
                                                            </div>
                                                            <div>
                                                                <button type="button" class="btn btn-dark btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal{{ $task->id }}">delete</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal edit -->
                                                    <div class="modal fade" id="editModal{{ $task->id }}"
                                                        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content p-2">
                                                                <form action="{{ route('task.update', $task) }}"
                                                                    method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="editModalLabel">
                                                                            Edit task</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <input type="hidden" name="lead_id"
                                                                                value="{{ $lead->id }}" required>
                                                                        </div>
                                                                        <div class="row">
                                                                            <label for="">Task name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="title" placeholder="Task name"
                                                                                value="{{ $task->title }}" required>
                                                                        </div>
                                                                        <div class="row">
                                                                            <label for="">Due at</label>
                                                                            <input type="datetime-local"
                                                                                class="form-control" name="due_at"
                                                                                value="{{ $task->due_at }}"
                                                                                placeholder="Task name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal delete -->
                                                    <div class="modal fade" id="deleteModal{{ $task->id }}"
                                                        tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content p-2">
                                                                <form action="{{ route('task.delete', $task) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="editModalLabel">
                                                                            Delete task</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <h3>Do you really want to delete
                                                                                ({{ $task->title }})
                                                                                ?</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">No</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Yes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal store -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-2">
                                                <form action="{{ route('task.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add task</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <input type="hidden" name="lead_id"
                                                                value="{{ $lead->id }}" required>
                                                        </div>
                                                        <div class="row">
                                                            <label for="">Task name</label>
                                                            <input type="text" class="form-control" name="title"
                                                                placeholder="Task name" required>
                                                        </div>
                                                        <div class="row">
                                                            <label for="">Due at</label>
                                                            <input type="datetime-local" class="form-control"
                                                                name="due_at" placeholder="Task name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @elseif (session('error'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="successToast" class="toast align-items-center text-white bg-danger border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @endif
        {{ $leads->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.forEach(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            });
        });
    </script>
@endsection
