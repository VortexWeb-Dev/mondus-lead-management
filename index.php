<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mondus - Lead Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 min-h-screen font-sans antialiased">
    <!-- Main Container -->
    <div class="max-w-4xl mx-auto p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Mondus</h1>
                <p class="text-sm text-gray-500">Lead Management</p>
            </div>
            <button id="uploadBtn" class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition-colors flex items-center gap-2">
                <i class="fas fa-upload"></i> Upload CSV
            </button>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-sm p-6 relative">
            <!-- Loading Overlay -->
            <div id="loadingOverlay" class="absolute inset-0 z-50 bg-gray-100 bg-opacity-75 flex items-center justify-center rounded-lg hidden">
                <div class="w-8 h-8 border-4 border-gray-900 border-t-transparent rounded-full animate-spin"></div>
            </div>

            <!-- Project Dropdown -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Project</label>
                <select id="projectSelect" class="w-full max-w-xs border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200">
                    <option value="">Select a project</option>
                </select>
            </div>

            <!-- Leads Stats -->
            <div class="flex gap-4 mb-6">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Leads</label>
                    <input id="totalLeads" type="number" readonly value="0" class="w-full border border-gray-300 rounded-md p-2 bg-gray-50 transition-all duration-200">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Leads</label>
                    <input id="assignedLeads" type="number" readonly value="0" class="w-full border border-gray-300 rounded-md p-2 bg-gray-50 transition-all duration-200">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Unassigned Leads</label>
                    <input id="unassignedLeads" type="number" readonly value="0" class="w-full border border-gray-300 rounded-md p-2 bg-gray-50 transition-all duration-200">
                </div>
            </div>

            <!-- Agents Section -->
            <div class="flex gap-4 mb-6">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Assign to Agent</label>
                    <select id="agentSelect" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200">
                        <option value="">Select an agent</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Number of Leads</label>
                    <input id="numberOfLeadsInput" type="number" min="0" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200">
                </div>
            </div>

            <!-- Submit Button -->
            <button id="submitBtn" class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition-colors duration-200">Submit</button>
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-center text-sm text-gray-500">
            © <a href="http://vortexweb.org" class="hover:underline">VortexWeb</a> <?php echo date('Y'); ?>
        </footer>
    </div>

    <!-- Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden animate-in fade-in zoom-in">
        <div id="modalContent" class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md transition-transform duration-300 scale-95 opacity-0">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Upload CSV</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Upload Form -->
            <form id="uploadForm" action="upload-csv.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="csvFile" class="block text-sm font-medium text-gray-700">Select CSV File</label>
                    <input type="file" id="csvFile" name="csvFile" accept=".csv" class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-gray-900 focus:outline-none">
                </div>

                <button type="submit" id="uploadSubmitBtn" class="w-full bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition active:scale-95">
                    Upload
                </button>
            </form>
        </div>
    </div>

    <!-- Toast -->
    <div id="toastContainer" class="fixed top-4 right-4 space-y-2 z-50"></div>

    <!-- JavaScript -->
    <script src="script.js">
    </script>
</body>

</html>