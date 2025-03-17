<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- App Header -->
            <div class="task-manager-header p-6 bg-purple-900 text-white rounded-2xl shadow-sm mb-6">
                <div class="sparkle"></div>
                <div class="sparkle"></div>
                <div class="sparkle"></div>
                <div class="sparkle"></div>
                
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-3 rounded-full mr-4 text-white">
                            <i class="fas fa-magic"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white flex items-center">
                                <i class="fas fa-magic mr-3 text-pink-400"></i>
                                <span class="font-quicksand font-bold">✨Task Planner✨</span>
                            </h1>
                            <p class="text-gray-300">Organize your tasks with a sprinkle of magic </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <button id="theme-toggle" class="p-2 rounded-full bg-purple-800 hover:bg-purple-700 transition-colors">
                            <i class="fas fa-sun text-yellow-300 dark:hidden"></i>
                            <i class="fas fa-moon text-yellow-300 hidden dark:block"></i>
                        </button>
                        <button id="add-task-btn" class="btn-primary">
                            <i class="fas fa-plus mr-2"></i> Add Task
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="stats-card mb-6">
                <h2 class="text-xl font-bold mb-4">Task Statistics</h2>
                
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="text-center">
                        <div class="bg-pink-100 dark:bg-purple-800 p-3 rounded-lg">
                            <h3 class="text-sm text-gray-600 dark:text-gray-300 mb-1">Total</h3>
                            <p class="text-2xl font-bold text-pink-600 dark:text-pink-400" id="total-count">0</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-lg">
                            <h3 class="text-sm text-gray-600 dark:text-gray-300 mb-1">Pending</h3>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400" id="pending-count">0</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg">
                            <h3 class="text-sm text-gray-600 dark:text-gray-300 mb-1">In Progress</h3>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="in-progress-count">0</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                            <h3 class="text-sm text-gray-600 dark:text-gray-300 mb-1">Completed</h3>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400" id="completed-count">0</p>
                        </div>
                    </div>
                </div>
                
                <div class="chart-container" style="height: 200px;">
                    <canvas id="task-chart"></canvas>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" id="search-input" class="form-control w-full pl-10" placeholder="Search tasks...">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="filter-btn bg-pink-100 dark:bg-purple-800 text-pink-600 dark:text-white px-4 py-2 rounded-full font-quicksand font-medium hover:bg-pink-200 dark:hover:bg-purple-700 transition-colors active" data-filter="all">All</button>
                        <button class="filter-btn bg-pink-100 dark:bg-purple-800 text-pink-600 dark:text-white px-4 py-2 rounded-full font-quicksand font-medium hover:bg-pink-200 dark:hover:bg-purple-700 transition-colors" data-filter="pending">Pending</button>
                        <button class="filter-btn bg-pink-100 dark:bg-purple-800 text-pink-600 dark:text-white px-4 py-2 rounded-full font-quicksand font-medium hover:bg-pink-200 dark:hover:bg-purple-700 transition-colors" data-filter="in-progress">In Progress</button>
                        <button class="filter-btn bg-pink-100 dark:bg-purple-800 text-pink-600 dark:text-white px-4 py-2 rounded-full font-quicksand font-medium hover:bg-pink-200 dark:hover:bg-purple-700 transition-colors" data-filter="completed">Completed</button>
                    </div>
                </div>
            </div>

            <!-- Task List -->
            <div class="space-y-4" id="task-list">
                <!-- Tasks will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Task Modal -->
    <div class="modal-backdrop hidden" id="task-modal">
        <div class="modal-content p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold" id="modal-title">✨ Create New Task ✨</h2>
                <button id="close-modal" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="task-form">
                <input type="hidden" id="task-id">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="title">Title 📝</label>
                    <input type="text" id="title" class="form-control w-full" placeholder="What's your magical task?" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="description">Description 📝</label>
                    <textarea id="description" class="form-control w-full" rows="3" placeholder="Describe your magical task in detail..."></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="status">Status 🔮</label>
                    <select id="status" class="form-control w-full">
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="priority">Priority ⭐</label>
                    <select id="priority" class="form-control w-full">
                        <option value="medium">Medium Priority</option>
                        <option value="low">Low Priority</option>
                        <option value="high">High Priority</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1" for="category">Category 📂</label>
                    <input type="text" id="category" class="form-control w-full" placeholder="Work, Personal, etc.">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-1" for="due_date">Due Date 📅</label>
                    <input type="date" id="due_date" class="form-control w-full" required>
                </div>
                
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancel-task" class="btn-secondary">
                        Cancel
                    </button>
                    <button type="submit" id="save-task" class="btn-primary">
                        <i class="fas fa-sparkles mr-2"></i> Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Load statistics
            loadStatistics();
            
            // Load tasks
            loadTasks();
            
            // Task Modal
            $('#add-task-btn').click(function() {
                $('#modal-title').text('✨ Create New Task ✨');
                $('#task-form')[0].reset();
                $('#task-id').val('');
                
                // Set default due date to tomorrow
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                $('#due_date').val(tomorrow.toISOString().split('T')[0]);
                
                $('#task-modal').removeClass('hidden');
            });
            
            $('#close-modal, #cancel-task').click(function() {
                $('#task-modal').addClass('hidden');
            });
            
            // Save Task
            $('#task-form').submit(function(e) {
                e.preventDefault();
                
                const taskId = $('#task-id').val();
                const isEdit = taskId !== '';
                
                const taskData = {
                    title: $('#title').val(),
                    description: $('#description').val(),
                    status: $('#status').val(),
                    priority: $('#priority').val(),
                    category: $('#category').val(),
                    due_date: $('#due_date').val()
                };
                
                const url = isEdit ? `/tasks/${taskId}` : '/tasks';
                const method = isEdit ? 'PUT' : 'POST';
                
                $.ajax({
                    url: url,
                    type: method,
                    data: taskData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#task-modal').addClass('hidden');
                        loadTasks();
                        loadStatistics();
                        
                        Swal.fire({
                            title: 'Success!',
                            text: isEdit ? 'Task updated successfully' : 'Task created successfully',
                            icon: 'success',
                            confirmButtonColor: '#ec4899'
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error',
                            confirmButtonColor: '#ec4899'
                        });
                    }
                });
            });
            
            // Filter Tasks
            $('.filter-btn').click(function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                
                const filter = $(this).data('filter');
                filterTasks(filter);
            });
            
            // Search Tasks
            $('#search-input').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                searchTasks(searchTerm);
            });
        });
        
        // Load Tasks
        function loadTasks() {
            $.ajax({
                url: '/tasks',
                type: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    console.log('Tasks loaded:', response);
                    renderTasks(response);
                },
                error: function(error) {
                    console.error('Error loading tasks:', error);
                }
            });
        }
        
        // Render Tasks
        function renderTasks(tasks) {
            const container = $('#task-list');
            container.empty();
            
            if (tasks.length === 0) {
                container.html(`
                    <div class="text-center py-8">
                        <i class="fas fa-tasks text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-400 font-quicksand">No tasks found. Create your first task!</p>
                    </div>
                `);
                return;
            }
            
            tasks.forEach(task => {
                const dueDate = task.due_date ? new Date(task.due_date).toLocaleDateString() : 'No due date';
                const statusClass = getStatusClass(task.status);
                const priorityClass = getPriorityClass(task.priority);
                
                const taskCard = `
                    <div class="task-card p-4 task-item" data-id="${task.id}" data-status="${task.status}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-bold">${task.title}</h3>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-500 hover:text-blue-700 edit-task" data-id="${task.id}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700 delete-task" data-id="${task.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">${task.description || 'No description'}</p>
                                <div class="mt-4 flex flex-wrap items-center gap-2">
                                    <span class="status-badge ${statusClass}">
                                        ${formatStatus(task.status)}
                                    </span>
                                    
                                    <span class="status-badge ${priorityClass}">
                                        ${formatPriority(task.priority)} Priority
                                    </span>
                                    
                                    ${task.category ? `
                                    <span class="status-badge bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                        ${task.category}
                                    </span>
                                    ` : ''}
                                    
                                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-auto">
                                        <i class="far fa-calendar-alt mr-1"></i> Due: ${dueDate}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                container.append(taskCard);
            });
            
            // Add event listeners to edit and delete buttons
            $('.edit-task').click(function() {
                const taskId = $(this).data('id');
                editTask(taskId);
            });
            
            $('.delete-task').click(function() {
                const taskId = $(this).data('id');
                deleteTask(taskId);
            });
        }
        
        // Edit Task
        function editTask(taskId) {
            $.ajax({
                url: `/tasks/${taskId}`,
                type: 'GET',
                success: function(task) {
                    $('#modal-title').text('✨ Edit Task ✨');
                    $('#task-id').val(task.id);
                    $('#title').val(task.title);
                    $('#description').val(task.description);
                    $('#status').val(task.status);
                    $('#priority').val(task.priority || 'medium');
                    $('#category').val(task.category || '');
                    $('#due_date').val(task.due_date);
                    
                    $('#task-modal').removeClass('hidden');
                },
                error: function(error) {
                    console.error('Error fetching task:', error);
                }
            });
        }
        
        // Delete Task
        function deleteTask(taskId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ec4899',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/tasks/${taskId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            loadTasks();
                            loadStatistics();
                            
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Your task has been deleted.',
                                icon: 'success',
                                confirmButtonColor: '#ec4899'
                            });
                        },
                        error: function(error) {
                            console.error('Error deleting task:', error);
                        }
                    });
                }
            });
        }
        
        // Load Statistics
        function loadStatistics() {
            $.ajax({
                url: '/tasks/statistics',
                type: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(stats) {
                    console.log('Statistics loaded:', stats);
                    // Update counters
                    $('#total-count').text(stats.total);
                    $('#pending-count').text(stats.pending);
                    $('#in-progress-count').text(stats.in_progress);
                    $('#completed-count').text(stats.completed);
                    
                    // Update chart
                    updateChart(stats);
                },
                error: function(error) {
                    console.error('Error loading statistics:', error);
                }
            });
        }
        
        // Update Chart
        function updateChart(stats) {
            const ctx = document.getElementById('task-chart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (window.taskChart) {
                window.taskChart.destroy();
            }
            
            window.taskChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Pending', 'In Progress', 'Completed'],
                    datasets: [{
                        data: [stats.pending, stats.in_progress, stats.completed],
                        backgroundColor: ['#EAB308', '#3B82F6', '#22C55E'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    family: 'Quicksand'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? Math.round((context.raw / total) * 100) : 0;
                                    return `${context.label}: ${context.raw} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // Filter Tasks
        function filterTasks(filter) {
            if (filter === 'all') {
                $('.task-item').show();
            } else {
                $('.task-item').hide();
                $(`.task-item[data-status="${filter}"]`).show();
            }
        }
        
        // Search Tasks
        function searchTasks(term) {
            $('.task-item').each(function() {
                const title = $(this).find('h3').text().toLowerCase();
                const description = $(this).find('p').text().toLowerCase();
                
                if (title.includes(term) || description.includes(term)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        
        // Helper Functions
        function getStatusClass(status) {
            switch (status) {
                case 'pending': return 'status-pending';
                case 'in-progress': return 'status-in-progress';
                case 'completed': return 'status-completed';
                default: return 'status-pending';
            }
        }
        
        function getPriorityClass(priority) {
            switch (priority) {
                case 'high': return 'priority-high';
                case 'medium': return 'priority-medium';
                case 'low': return 'priority-low';
                default: return 'priority-medium';
            }
        }
        
        function formatStatus(status) {
            switch (status) {
                case 'pending': return 'Pending';
                case 'in-progress': return 'In Progress';
                case 'completed': return 'Completed';
                default: return 'Pending';
            }
        }
        
        function formatPriority(priority) {
            switch (priority) {
                case 'high': return 'High';
                case 'medium': return 'Medium';
                case 'low': return 'Low';
                default: return 'Medium';
            }
        }
    </script>
    @endpush
</x-app-layout> 