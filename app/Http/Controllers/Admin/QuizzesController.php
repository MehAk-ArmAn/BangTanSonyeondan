<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizGame;
use App\Models\QuizGameQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class QuizzesController extends Controller
{
    public function index()
    {
        return view('admin.quizzes.index', [
            'quizzes' => QuizGame::with([
                    'questions' => fn ($query) => $query->orderBy('sort_order')->orderBy('id'),
                ])
                ->withCount('attempts')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedQuiz($request);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured');

        $uploaded = $this->uploadAdminImage($request, 'cover_file', 'quizzes');
        if ($uploaded) {
            $data['cover_image'] = $uploaded;
        }

        unset($data['cover_file']);

        QuizGame::create($data);

        return back()->with('success', 'Quiz created successfully.');
    }

    public function update(Request $request, QuizGame $quiz)
    {
        $data = $this->validatedQuiz($request, $quiz->id);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        $uploaded = $this->uploadAdminImage($request, 'cover_file', 'quizzes');
        if ($uploaded) {
            $data['cover_image'] = $uploaded;
        }

        unset($data['cover_file']);

        $quiz->update($data);

        return back()->with('success', 'Quiz updated successfully.');
    }

    public function destroy(QuizGame $quiz)
    {
        $quiz->delete();

        return back()->with('success', 'Quiz deleted successfully.');
    }

    public function storeQuestion(Request $request, QuizGame $quiz)
    {
        $data = $this->validatedQuestion($request);

        $data['quiz_game_id'] = $quiz->id;
        $data['options'] = $this->parseOptions($request->input('options_text'));
        $data['is_active'] = $request->boolean('is_active', true);

        unset($data['options_text']);

        QuizGameQuestion::create($data);

        return back()->with('success', 'Question added successfully.');
    }

    public function updateQuestion(Request $request, QuizGameQuestion $question)
    {
        $data = $this->validatedQuestion($request);

        $data['options'] = $this->parseOptions($request->input('options_text'));
        $data['is_active'] = $request->boolean('is_active');

        unset($data['options_text']);

        $question->update($data);

        return back()->with('success', 'Question updated successfully.');
    }

    public function destroyQuestion(QuizGameQuestion $question)
    {
        $question->delete();

        return back()->with('success', 'Question deleted successfully.');
    }

    private function validatedQuiz(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('quiz_games', 'slug')->ignore($ignoreId),
            ],

            'category' => ['required', 'string', 'max:120'],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard', 'legendary'])],

            'description' => ['nullable', 'string', 'max:1000'],

            'cover_image' => ['nullable', 'string', 'max:1000'],
            'cover_file' => ['nullable', 'image', 'max:4096'],

            'time_limit_seconds' => ['nullable', 'integer', 'min:0', 'max:7200'],
            'points_per_question' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'bonus_points' => ['nullable', 'integer', 'min:0', 'max:1000000'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function validatedQuestion(Request $request): array
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
            'options_text' => ['required', 'string'],
            'correct_option' => ['required', 'integer', 'min:0', 'max:9'],
            'explanation' => ['nullable', 'string', 'max:2000'],
            'points' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $options = $this->parseOptions($request->input('options_text'));

        if (count($options) < 2) {
            throw ValidationException::withMessages([
                'options_text' => 'Add at least 2 answer options.',
            ]);
        }

        if ((int) $data['correct_option'] >= count($options)) {
            throw ValidationException::withMessages([
                'correct_option' => 'Correct option number must match one of the listed options. Start counting from 0.',
            ]);
        }

        return $data;
    }

    private function parseOptions(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function uploadAdminImage(Request $request, string $field, string $folder): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        if (! $file || ! $file->isValid()) {
            return null;
        }

        $path = $file->store('admin/' . $folder, 'public');

        return 'storage/' . $path;
    }
}
