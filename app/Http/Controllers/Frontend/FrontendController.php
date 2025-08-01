<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Event;
use App\Models\Notice;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\PopupNotice;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function index()
  {
    $latestNews = News::latest()->take(6)->get();
    $upcomingEvents = Event::where('event_date', '>=', now())->orderBy('event_date')->take(3)->get();
    $latestNotices = Notice::where('is_published', true)->latest()->take(5)->get();
    $teachers = Teacher::where('status', 'active')->take(8)->get();
    $gallery = Gallery::latest()->take(6)->get();
    $popupNotice = PopupNotice::where('is_active', true)->first();

    return view('frontend.home', compact('latestNews', 'upcomingEvents', 'latestNotices', 'teachers', 'gallery', 'popupNotice'));
  }

  public function teachers()
  {
    $teachers = Teacher::where('status', 'active')->paginate(12);
    return view('frontend.teachers', compact('teachers'));
  }

  public function news()
  {
    $news = News::latest()->paginate(9);
    return view('frontend.news', compact('news'));
  }

  public function newsDetail($slug)
  {
    $news = News::where('slug', $slug)->firstOrFail();
    $relatedNews = News::where('id', '!=', $news->id)->latest()->take(3)->get();

    return view('frontend.news-detail', compact('news', 'relatedNews'));
  }

  public function events()
  {
    $events = Event::orderBy('event_date')->paginate(9);
    return view('frontend.events', compact('events'));
  }

  public function notices()
  {
    $notices = Notice::where('is_published', true)->latest()->paginate(10);
    return view('frontend.notices', compact('notices'));
  }
}
