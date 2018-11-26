<?PHP
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Climb;
use Log;

class ClimbController extends Controller {
    public function postClimb(Request $request) {
        $climb = new Climb();
        $climb->comment   = $request->input('comment');
        $climb->name      = $request->input('name');
        $climb->grade     = $request->input('grade');
        $climb->gradeType = $request->input('gradeType');
        $climb->creator   = $request->input('creator');
        $climb->creatorId = $request->input('creatorId');
        $climb->posLng    = $request->input('posLng');
        $climb->posLat    = $request->input('posLat');
        $climb->images    = "";
        $climb->save();

        $file = $request->file('climbFile');
        $filename = "public/climb_".$climb->id."_0.jpg";        

        if($file) {
            Log::info($file);
            Storage::disk('local')->put($filename,File::get($file));
        }

        $climb = Climb::find($climb->id);
        $climb->images   = $climb->id."_0";
        $climb->save();

        return response()->json(['climb' => $climb],201);
    }
    public function getClimbs(Request $request) {
        $climbs = Climb::all();
        return response()->json(['climbs'=>$climbs],200);
    }
    public function putClimb(Request $request, $id) {
        $climb = Climb::find($id);
        if (!$climb) {
            return response()->json(['message' => 'climb not found'],404);
        }
        $climb->comment   = $request->input('comment');
        $climb->name      = $request->input('name');
        $climb->grade     = $request->input('grade');
        $climb->gradeType = $request->input('gradeType');
        $climb->creator   = $request->input('creator');
        $climb->creatorId = $request->input('creatorId');
        $climb->posLng    = $request->input('posLng');
        $climb->posLat    = $request->input('posLat');
        $climb->save();
        return response()->json(['climb' => $climb],200);

    }
    public function getClimb(Request $request,$id) {
        $climb = Climb::find($id);
        if (!$climb) {
            return response()->json(['mesage' => 'climb not found'],404);
        }
        return response()->json(['climb' => $climb],200);
    }
    public function deleteClimb(Request $request,$id) {
        $climb = Climb::find($id);
        if (!$climb) {
            return response()->json(['mesage' => 'climb not found'],404);
        }
        $climb->delete();
        return response()->json(['message' => 'climb delete'],200);
    }

}