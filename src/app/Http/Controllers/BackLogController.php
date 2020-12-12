<?php


namespace App\Http\Controllers;


use App\Http\ViewModels\BackLog\BackLogIndexViewModel;
use App\Http\ViewModels\BackLog\UserStoryViewModel;
use Basic\Exception\NotFoundException;
use Illuminate\Http\Request;
use Scrum\Application\Service\BackLog\AddUserStoryCommand;
use Scrum\Application\Service\BackLog\BackLogApplicationService;
use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Application\Service\BackLog\Query\UserStorySummary;

class BackLogController extends Controller
{
    public function index(BackLogQueryServiceInterface $backLogQueryService)
    {
        $userStories = $backLogQueryService->getAllUserStory();

        $userStoriesViewModels = collect($userStories)->map(function (UserStorySummary $summary) {
            return new UserStoryViewModel(
                $summary->id,
                $summary->story,
                $summary->author,
                $summary->demo,
                $summary->estimation
            );
        })->all();

        $viewModel = new BackLogIndexViewModel($userStoriesViewModels);

        return view("backlog/index", compact("viewModel"));
    }

    public function getUserStory(string $id, BackLogApplicationService $applicationService)
    {
        $story = $applicationService->getUserStory($id);
        if (is_null($story)) {
            throw new NotFoundException($id . " is notfound.");
        }

        $viewModel = new UserStoryViewModel(
            $story->getId()->getValue(),
            $story->getStory(),
            $story->getAuthor()->getValue(),
            $story->getDemo(),
            $story->getEstimation()
        );

        return view("backlog/user-story/index", compact("viewModel"));
    }

    public function getAddUserStory()
    {
        return view("backlog/add-user-story");
    }

    public function postAddUserStory(Request $request, BackLogApplicationService $applicationService)
    {
        $request->validate([
            "story" => "required"
        ]);

        $story = $request->input("story");

        $command = new AddUserStoryCommand($story);
        $applicationService->addUserStory($command);

        return redirect()->action([BackLogController::class, "index"]);
    }

    public function estimateUserStory(string $id, Request $request, BackLogApplicationService $applicationService)
    {
        $estimation = $request->get("estimation");
        $applicationService->estimateUserStory($id, $estimation);
    }
}
