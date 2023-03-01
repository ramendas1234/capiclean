<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase ;
    public function testBlogPostWithOutComment()
    {
        // arrarnge part
        $post = $this->createDummyPost();

        // Act
        $response = $this->get('/posts');
        // Assert
        $response->assertSeeText('Celebrities Nude on Purpose');
        $response->assertSeeText('0 comments');
        $this->assertDatabaseHas('blog_posts',[
            'title' => 'Celebrities Nude on Purpose'
        ]);
    }


    public function testBlogPostWithDummyComment()
    {
        // arrarnge part
        $post = $this->createDummyPost();
        $comment = Comment::factory()->count(4)->create([
            'blog_post_id' => $post->id,
        ]);

        

        // Act
        $response = $this->get('/posts');
        // Assert
        $response->assertSeeText('4 comments');
        
    }

    public function testStoreValid()
    {
        $user = $this->user();
        $params = [
            'title'=>'Top 10 bestselling bikes',
            'content'=> 'Are you worried about those narrow, rippled streaks on your skin? Want to know why these occur, and how can you get rid of them?Those bands that appear on your skin in the form of irregular stripes are called stretch marks. As the name suggests, these appear when our skin stretches and then shrinks rapidly. ',
            'user_id' => $user->id
        ];

        
        

        // Act
        $this->actingAs($user)->post('/posts', $params)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post created successfully');

    }

    public function testStoreFail()
    {
        $params = [
            'title'=>'xx',
            'content'=> 'xxxxxx'
        ];

        $this->actingAs($this->user())->post('/posts', $params)->assertStatus(302)->assertSessionHas('errors');
        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0],'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0],'The content must be at least 50 characters.');
    }

    public function testBlogPostUpdate()
    {

        $post = $this->createDummyPost();

        

        $params = [
            'title'=>'30 Former Stars Who Quit Showbiz for Normal Jobs',
            'content'=> 'During the late nineties and early twenties, Freddie Prinze Jr. was the nation’s rising star. He was virtually everywhere. The actor achieved fame for his incredible comic timing and heartfelt romcoms that made him the most promising heartthrob of the 90s. Even in unconventional movies such as She’s All That and I Know What'
        ];

        $this->actingAs($this->user())->put("/posts/{$post->id}", $params)->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Post updated successfully');

        $this->assertDatabaseMissing('blog_posts',$post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title'=> '30 Former Stars Who Quit Showbiz for Normal Jobs'
        ]);

        

    }

    public function testBlogPostDelete(){

        $post = $this->createDummyPost();
        $this->actingAs($this->user())->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'),'Blog post was deleted!');
        $this->assertDatabaseMissing('blog_posts',$post->toArray());

    }

    public function createDummyPost($userId = null): BlogPost
    {
        // arrarnge part

        
        // $post = new BlogPost();
        // $post->title = 'Celebrities Nude on Purpose';
        // $post->content = 'There have been incidences like when well-known stars posed nude mistakenly. Such as when Cardi B uploaded her nude pics or when Chris Evans’s unfortunate nude shot at the NSFW. You can refer to them as inevitable celebrities oops moments. Many celebs have become victims of nude photo leaks, and that’s something they have endorsed as a part of the package.';
        // $post->save();

        return BlogPost::factory()->create(['title' => 'Celebrities Nude on Purpose', 'user_id' => $userId ?? $this->user()->id]);
    }


}
