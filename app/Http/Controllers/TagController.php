<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->orderBy('name')->get();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        Tag::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag added.');
    }

    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        $request->validate($this->rules());
        $tag->update(['name' => $request->name]);

        return redirect()->route('tags.index')->with('success', 'Tag updated.');
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

}
