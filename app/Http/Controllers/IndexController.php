<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Auth;

use Cookie;
use Log;

use App\Tools\RspTools;
use App\Logics\ReadUserByOpenidLogic;

class IndexController extends Controller {

	public function index(Request $request) {
		$url = 'https://mp.weixin.qq.com/s?__biz=MzI5MjMyNjk2Mg==&mid=2247490598&idx=1&sn=26bc12838a78928f68168ecf9e62b877&chksm=ec02477bdb75ce6d2420a755a81e6b9dd3e7546f6b995f8d0568fe4d3429bc3ed4846f7ac12c#rd';
		// 创建提取实例
		$textractor = new \Lukin\Textractor\Textractor();;
		// 下载并解析文章
		$article = $textractor->download($url)->parse();

		$rtn = [
			'url'			=>	$url,
			'Title'			=>	$article->getTitle(),
			'Publish'		=>	$article->getPublishDate(),
			'Text'			=>	$article->getText(),
			'Content'		=>	$article->getHTML()
		];

		return response()->json($rtn);

		// printf('<div id="url">URL: %s</div>' . PHP_EOL, $url);
		// printf('<div id="title">Title: %s</div>' . PHP_EOL, $article->getTitle());
		// printf('<div id="published">Publish: %s</div>' . PHP_EOL, $article->getPublishDate());
		// printf('<div id="text">Text: <pre>%s</pre></div>' . PHP_EOL, $article->getText());
		// printf('<div id="html">Content: %s</div>' . PHP_EOL, $article->getHTML());
	}

}