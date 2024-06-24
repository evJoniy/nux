<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\HistoryServiceInterface;
use App\Services\Interfaces\LinkServiceInterface;
use App\Services\Interfaces\LuckyServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class InteractionController extends Controller
{
    public function __construct(
        private LinkServiceInterface    $linkService,
        private HistoryServiceInterface $historyService,
        private LuckyServiceInterface   $luckyService,
    ) {
    }

    /**
     * @param string $token
     * @return View|RedirectResponse
     */
    public function show(string $token): View|RedirectResponse
    {
        if (!$this->linkService->isLinkValid($token)) {
            return redirect('/')->with('error', 'Link has expired or is invalid.');
        }

        return view('interaction_page', compact('token'));
    }

    /**
     * @param string $token
     * @return string
     */
    public function regenerate(string $token): string
    {
        return $this->linkService->regenerate($token);
    }

    /**
     * @param string $token
     * @return void
     */
    public function deactivate(string $token): void
    {
        $this->linkService->deactivate($token);
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    public function lucky(string $token): JsonResponse
    {
        return new JsonResponse($this->luckyService->getLucky($token));
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function history(string $token): mixed
    {
        return $this->historyService->getLatestRecords($token);
    }
}
