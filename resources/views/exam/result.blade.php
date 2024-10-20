@include('layout.head')
<div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Exam Results</h1>
            <p class="text-gray-600 mt-2">Here's how you did on the exam:</p>
        </div>

        <!-- Skor -->
        <div class="bg-blue-100 p-6 rounded-lg text-center mb-8">
            <h2 class="text-4xl font-bold text-blue-700">85%</h2>
            <p class="text-lg text-blue-600">Your Score</p>
        </div>

        <!-- Detail Jawaban -->
        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Answer Summary</h3>
            <ul class="space-y-3">
                <li class="flex justify-between">
                    <span>Question 1</span>
                    <span class="text-green-600 font-bold">Correct</span>
                </li>
                <li class="flex justify-between">
                    <span>Question 2</span>
                    <span class="text-red-600 font-bold">Incorrect</span>
                </li>
                <li class="flex justify-between">
                    <span>Question 3</span>
                    <span class="text-green-600 font-bold">Correct</span>
                </li>
                <li class="flex justify-between">
                    <span>Question 4</span>
                    <span class="text-green-600 font-bold">Correct</span>
                </li>
            </ul>
        </div>

        <!-- Feedback -->
        <div class="bg-green-100 p-6 rounded-lg text-center mb-8">
            <h3 class="text-2xl font-semibold text-green-700">Great Job!</h3>
            <p class="text-gray-700 mt-2">You passed the exam. Keep up the good work and continue practicing to improve
                your skills!</p>
        </div>

        <!-- Aksi -->
        <div class="flex justify-center gap-4">
            <a href="/beginner/exam" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Retake Exam</a>
            <a href="/" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Go to Dashboard</a>
        </div>
    </div>
</div>

@include('layout.footer')
