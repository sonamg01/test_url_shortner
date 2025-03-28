<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use function Symfony\Component\Clock\now;

class ShortLinkController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortCode = str::random(6);

        $shortLink = ShortLink::create([
            'user_id' => Auth::id(),
            'original_url' => $request->original_url,
            'short_url' => $shortCode,
            'expires_at' => Carbon::now()->addDays(30),
        ]);

        return redirect('/success')->with('short_url', url('/short/' . $shortCode));
    }

    public function success()
    {
        return view('success');
    }
    public function redirect($code)
    {
        $shortLink = ShortLink::where('short_url', $code)->firstOrFail();

        return redirect($shortLink->original_url);
    }

    public function showLinks()
    {
        $links = ShortLink::where('user_id', Auth::id())->get();
        return view('links', compact('links'));
    }

    public function edit($id)
    {
        $link = ShortLink::findOrFail($id);
        return view('edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'short_url' => 'required',
            'original_url' => 'required|url',
            'expires_at' => 'required',
        ]);

        $link = ShortLink::findOrFail($id);
        $link->update([
            'short_url' => $request->short_url,
            'original_url' => $request->original_url,
            'expires_at' => $request->expires_at,
        ]);


        return redirect()->route('links.index')->with('success', 'Link update successful!');
    }

    public function destroy($id){
        $link = ShortLink::findOrFail($id);
        $link->delete();
        return redirect()->back()->with('success', 'Link delete successful!');

    }

    public function toggleStatus($id){
        $link = ShortLink::findOrFail($id);

        $link->status = !$link->status;
        $link->save();
        return redirect()->back()->with('success', 'status update successful!');


    }
}
