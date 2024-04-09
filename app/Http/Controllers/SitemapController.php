<?php

namespace App\Http\Controllers;

use App\Kodesign\SitemapGenerator;
use App\Models\Course;
use App\Models\Podcast;
use App\Models\Post;
use Conner\Tagging\Model\Tag;

class SitemapController extends Controller
{
    protected SitemapGenerator $sitemap_generator;

    public function index(SitemapGenerator $SitemapGenerator): \Illuminate\Http\RedirectResponse
    {
        $this->sitemap_generator = $SitemapGenerator;

        $this->generatePagesUrls();
        $this->generateCourseUrls();
        $this->generatePostsUrls();
        $this->generatePodcastsUrls();
        $this->generateTagsUrls();

        $this->sitemap_generator->write();

        return redirect()->route('admin.dashboard')->with('success', 'ساخت نقشه سایت با موفقیت انجام شد');
    }

    protected function generatePagesUrls(): void
    {
        $this->sitemap_generator->addLink(route('front.home'), now());
        $this->sitemap_generator->addLink(route('front.about'), now());
        $this->sitemap_generator->addLink(route('course.list'), now());
        $this->sitemap_generator->addLink(route('front.blog'), now());
        $this->sitemap_generator->addLink(route('front.podcast'), now());
        $this->sitemap_generator->addLink(route('login'), now());
        $this->sitemap_generator->addLink(route('password.request'), now());
    }

    protected function generateCourseUrls()
    {
        /* @var Course $course */
        foreach (Course::all() as $course) {
            $this->sitemap_generator->addLink($course->viewLink(), now(), image_path: $course->featuredImage(), image_title: $course->title);
        }
    }

    protected function generatePostsUrls()
    {
        /* @var Post $post */
        foreach (Post::published()->get() as $post) {
            $this->sitemap_generator->addLink($post->viewLink(), now());
        }
    }

    protected function generatePodcastsUrls()
    {
        /* @var Podcast $podcast */
        foreach (Podcast::published()->get() as $podcast) {
            $this->sitemap_generator->addLink($podcast->viewLink(), now());
        }
    }

    protected function generateTagsUrls()
    {
        $tags = Tag::where('count', '>', 0)->get();

        foreach ($tags as $tag) {
            $this->sitemap_generator->addLink(route('tag.show', $tag->slug), now());
        }
    }
}
